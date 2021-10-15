<?php

namespace App\Http\Controllers;

use App\Models\Pageview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageviewController extends Controller
{

    public function getAll() {
        return response()->json(Pageview::all());
    }

    public function getAllCount() {
        return response()->json(DB::table('pageviews')->selectRaw('uri, count(*) AS pageviews')->groupBy('uri')->get());
    }

    public function create(Request $request) {
        $pageview = new Pageview();
        
        $pageview->uri = $request->uri;
        $pageview->timestamp = $this->calculateHourlyRoundedTimestamp();
        $pageview->refererHash = $this->createRefererHash($request, $pageview->timestamp);
        $pageview->ip = $request->ip();
        $pageview->userAgent = $request->header(('User-Agent'));

        $pageview->save();
    }

    private function calculateHourlyRoundedTimestamp() {
        $timestamp = time();
        return $timestamp - ($timestamp % 3600);
    }

    private function createRefererHash(Request $request, $timestamp) {
        return sha1($request->ip() . $request->header('User-Agent') . $timestamp);
    }
}
