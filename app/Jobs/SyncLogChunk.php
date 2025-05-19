<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SyncLogChunk implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $chunk;

    public function __construct($chunk)
    {
        $this->chunk = $chunk;
    }

    public function handle()
    {
        $postData = [
            'logData' => $this->chunk->toArray()
        ];

        // $response = Http::post('https://step.breachsoft.com/public/api/sync_data', $postData);
        $response = Http::post('https://shoeposonlineserverdemo.nescostore.com/public/api/sync_data', $postData);

        if ($response->successful()) {
            DB::table('log_table')
                ->whereIn('id', collect($this->chunk)->pluck('id'))
                ->update(['status' => 1]);
        }
    }
}
