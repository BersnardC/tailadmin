<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Tail;
use App\Http\Controllers\UtilTails;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Item::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = Item::where('code', $request->code)->where('created_at', date('Y-m-d'))->where('status', 0)->first();
        if ($item) {
            return response()->json(['code' => 'warning', 'message' => 'Código ya asignado a la cola'], 200);
        }
        $start = new \DateTime();
        $data_tail = null;
        $stimated_time = 0;
        $min_minutes = 0;
        $Utt = new UtilTails();
        if ($request->assignment == 0) {
            # Asignar la mas ótima - Que saldrá más rápido
            $data_tail = $Utt->get_best_tail();
        } else {
            # Obtenemos la data de la cola definida
            $xtail = Tail::find($request->assignment);
            $data_tail = $Utt->stimated_times($xtail, $start);
            if ($data_tail['total_items'] == $data_tail['tail']->max_items) {
                return response()->json(['code' => 'warning', 'message' => 'La cola # '.$xtail->id.' ya ha llegado a su límite'], 200);
            }
        }
        $item = new Item();
        $item->tail_id = $data_tail['tail']->id;
        $item->name = $request->name;
        $item->created_at = $start->format('Y-m-d');
        $item->start = $start->format('H:i:s');
        $item->status = 0;
        $item->atention_time = 0;
        $item->code = $request->code;
        $item->save();
        return response()->json(['code' => 'success', 'item' => $item, 'tail' => $data_tail, 'minutes' => $min_minutes], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = Item::find($id);
        $item->status = $request->status == '11' ? 2 : 1;
        $item->save();
        return response()->json(['code' => 'success', 'item' => $item], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
