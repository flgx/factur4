<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Reports\Controllers;

use FI\Http\Controllers\Controller;
use FI\Modules\Reports\Repositories\ProfitLossReportRepository;
use FI\Modules\Reports\Validators\ReportValidator;
use FI\Support\DateFormatter;
use FI\Support\PDF\PDFFactory;

class ProfitLossReportController extends Controller
{
    public function __construct(
        ProfitLossReportRepository $profitLossReportRepository,
        ReportValidator $reportValidator
    )
    {
        parent::__construct();

        $this->profitLossReportRepository = $profitLossReportRepository;
        $this->reportValidator            = $reportValidator;
    }

    public function index()
    {
        return view('reports.profit_loss');
    }

    public function validate()
    {
        $validator = $this->reportValidator->getDateRangeValidator(request()->all());

        if ($validator->fails())
        {
            return response()->json([
                'success' => false,
                'errors'  => $validator->messages()->toArray()
            ], 400);
        }

        return response()->json(['success' => true]);
    }

    public function html()
    {
        $results = $this->profitLossReportRepository->getResults(
            DateFormatter::unformat(request('from_date')),
            DateFormatter::unformat(request('to_date')));

        return view('reports._profit_loss')
            ->with('results', $results);
    }

    public function pdf()
    {
        $pdf = PDFFactory::create();

        $results = $this->profitLossReportRepository->getResults(
            DateFormatter::unformat(request('from_date')),
            DateFormatter::unformat(request('to_date')));

        $html = view('reports._profit_loss')
            ->with('results', $results)->render();

        $pdf->download($html, trans('fi.profit_and_loss') . '.pdf');
    }
}