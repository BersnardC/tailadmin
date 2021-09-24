<?php 
namespace App\Http\Controllers;
use App\Models\Tail;
use App\Models\Item;

class UtilTails {

	public function get_best_tail($start = null) {
		$start = $start ?? new \DateTime();
        $best_tail = null;
        $tails = Tail::where('status', 1)->get();
        foreach ($tails as $tail) {
            $data_tail = $this::stimated_times($tail, $start);
            if ($data_tail['total_items'] < $tail->max_items) {
                if (!$best_tail) {
                    $best_tail = $data_tail;
                } else {
                    if ($data_tail['minutes'] < $best_tail['minutes']) {
                        $best_tail = $data_tail;
                    } else if($data_tail['minutes'] == $best_tail['minutes']) {
                        if ($data_tail['seconds'] < $best_tail['seconds']) {
                            $best_tail = $data_tail;
                        } else if ($data_tail['seconds'] == $best_tail['seconds']) {
                            if ($data_tail['total_items'] < $best_tail['total_items']) {
                                $best_tail = $data_tail;
                            }
                        }
                    }
                }
            }
        }
        return $best_tail;
	}

	public function stimated_times($tail, $start_time = null) : array {
        $minutes = 0;
        $seconds = 0;
        $start_time = $start_time ?? new \DateTime();
        $items = Item::where('tail_id', $tail->id)->where('created_at', date('Y-m-d'))->where('status','<=',1)->get();
        foreach ($items as $item) {
            if ($item->status == 0) {
                $minutes +=$tail->duration;
            } else {
                $item_date = new \DateTime($item->created_at.' '.$item->start);
                $date_dif = $start_time->diff($item_date);
                $minutes+= $date_dif->i;
                $seconds+= $date_dif->s;
            }
        }
        $final_time = (clone $start_time)->modify('+'.$minutes.' minute')->modify('+'.$seconds.' second')->format('H:i:s');
        return ['tail' => $tail, 'start_time' => $start_time->format('H:i:s'), 'final_time' => $final_time, 'minutes' => $minutes, 'seconds' => $seconds, 'total_items' => count($items)];
    }
}
?>