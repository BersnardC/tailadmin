<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tail;
use App\Models\Item;
use App\Http\Controllers\UtilTails;

class TailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['tails' => Tail::with('items')->get()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    public function dashboard() {
        $tails = Tail::get();
        foreach ($tails as $tail) {
            $tail->items = Item::where('tail_id', $tail->id)->where('status','<=',1)->get(); #->where('created_at', date('Y-m-d'))
        }
        return view('dashboard', [
            'tails' => $tails
        ]);
    }

    public function get_best_time() {
        $Utt = new UtilTails();
        $best_tail = $Utt->get_best_tail();
        return response()->json($best_tail);
    }

    public function get_tails_times(Request $request, $id) {
        $Utt = new UtilTails();
        $tail = Tail::find($id);
        $data = $Utt->stimated_times($tail);
        return response()->json($data);
    }
    /**
     * Carga la data inicial para correr la aplicación.
     */
    public function load_data()
    {
        $fecha = new \DateTime();
        $tails_data = [
            ['agent' => 'Lisa Lee', 'duration' => 2, 'average_time' => 2, 'max_items' => 100, 'status' => 1],
            ['agent' => 'Louis Garnerd', 'duration' => 3, 'average_time' => 3, 'max_items' => 50, 'status' => 1],
            ['agent' => 'Annie Lane', 'duration' => 1, 'average_time' => 1, 'max_items' => 100, 'status' => 0]
        ];
        $items_data = [
            # Antiguos
            ['code' => 2384, 'name' => 'Erick Freud', 'created_at' => date('Y-m-d', strtotime('20-09-2021')), 'start' => '08:45:00', 'finish' => '08:47:00', 'atention_time' => 2.0, 'status' => 2, 'tail_id' => 1],
            ['code' => 1029, 'name' => 'María Carrie', 'created_at' => date('Y-m-d', strtotime('20-09-2021')), 'start' => '09:45:00', 'finish' => '09:47:00', 'atention_time' => 2.0, 'status' => 2, 'tail_id' => 1],
            # Actuales
            ['code' => 1452, 'name' => 'Peter Park', 'created_at' => $fecha->format('Y-m-d'), 'start' => $fecha->format('H:i:s'), 'finish' => null, 'atention_time' => 0, 'status' => 0, 'tail_id' => 1],
            ['code' => 1352, 'name' => 'Helem S.', 'created_at' => $fecha->format('Y-m-d'), 'start' => $fecha->format('H:i:s'), 'finish' => null, 'atention_time' => 0, 'status' => 0, 'tail_id' => 2]
        ];
        $tails = Tail::all();
        if (!count($tails)) {
            foreach ($tails_data as $tail) {
                Tail::create($tail);
            }
        }
        $items = Item::all();
        if (!count($items)) {
            foreach ($items_data as $item) {
                Item::create($item);
            }
        }
        $tails = Tail::all();
        $items = Item::all();
        echo json_encode('Data cargada.');
        dd([$tails, $items]);
    }
}
