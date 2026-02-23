<?php

namespace App\Http\Controllers;

use App\Services\DateDistanceService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DateDistanceController extends Controller
{
    public function __construct(
        private DateDistanceService $dateService
    ) {
    }

    public function index(Request $request): View
    {
        $targetDate = $request->query('date');
        $fromDate = $request->query('from');

        $result = null;

        if ($targetDate && $this->dateService->isValidDate($targetDate)) {
            if ($fromDate && !$this->dateService->isValidDate($fromDate)) {
                $fromDate = null;
            }

            $result = $this->dateService->calculate($targetDate, $fromDate);
        }

        return view('date-distance.index', [
            'targetDate' => $targetDate,
            'fromDate' => $fromDate,
            'result' => $result,
        ]);
    }

    public function calculate(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'from' => 'nullable|date',
        ]);

        $result = $this->dateService->calculate(
            $validated['date'],
            $validated['from'] ?? null
        );

        return response()->json($result);
    }
}
