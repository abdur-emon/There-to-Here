<?php

namespace App\Http\Controllers;

use App\Services\DateDistanceService;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * DateDistanceController
 * 
 * Handles the "How Long?" application
 * 
 * Architecture Decision:
 * - Server-rendered Blade for SEO and initial state
 * - TypeScript handles client-side calculations
 * - Controller provides initial data and validates inputs
 */
class DateDistanceController extends Controller
{
    public function __construct(
        private DateDistanceService $dateService
    ) {}
    
    /**
     * Display the date distance calculator
     * 
     * This method:
     * 1. Reads URL parameters (for deep linking)
     * 2. Validates dates if provided
     * 3. Calculates initial result if dates are valid
     * 4. Passes data to Blade for hydration
     * 
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        // Extract query parameters
        $targetDate = $request->query('date');
        $fromDate = $request->query('from');
        $theme = $request->query('theme', 'dark');
        
        // Initialize result as null
        $result = null;
        
        // If we have a target date, validate and calculate
        if ($targetDate && $this->dateService->isValidDate($targetDate)) {
            // Validate from date if provided
            if ($fromDate && !$this->dateService->isValidDate($fromDate)) {
                $fromDate = null;
            }
            
            // Calculate the distance
            $result = $this->dateService->calculate($targetDate, $fromDate);
        }
        
        return view('date-distance.index', [
            'targetDate' => $targetDate,
            'fromDate' => $fromDate,
            'theme' => $theme,
            'result' => $result,
        ]);
    }
    
    /**
     * API endpoint for client-side calculations
     * 
     * This allows TypeScript to request calculations without page reload
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
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

