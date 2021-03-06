<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Expenses\Controllers;

use FI\Http\Controllers\Controller;
use FI\Modules\Expenses\Repositories\ExpenseCategoryRepository;
use FI\Modules\Expenses\Repositories\ExpenseRepository;
use FI\Modules\Expenses\Repositories\ExpenseVendorRepository;
use FI\Support\BackPath;

class ExpenseController extends Controller
{
    public function __construct(
        ExpenseCategoryRepository $expenseCategoryRepository,
        ExpenseRepository $expenseRepository,
        ExpenseVendorRepository $expenseVendorRepository)
    {
        parent::__construct();

        $this->expenseCategoryRepository = $expenseCategoryRepository;
        $this->expenseRepository         = $expenseRepository;
        $this->expenseVendorRepository   = $expenseVendorRepository;
    }

    public function index()
    {
        return view('expenses.index')
            ->with('expenses', $this->expenseRepository->paginate(request('search'), request('category'), request('vendor'), request('status')))
            ->with('displaySearch', true)
            ->with('categories', ['' => trans('fi.all_categories')] + $this->expenseCategoryRepository->lists())
            ->with('vendors', ['' => trans('fi.all_vendors')] + $this->expenseVendorRepository->lists())
            ->with('statuses', ['' => trans('fi.all_statuses'), 'billed' => trans('fi.billed'), 'not_billed' => trans('fi.not_billed'), 'not_billable' => trans('fi.not_billable')]);
    }

    public function delete($id)
    {
        $this->expenseRepository->delete($id);

        return redirect()->to(BackPath::getBackPath('expenses'))
            ->with('alertInfo', trans('fi.record_successfully_deleted'));
    }
}