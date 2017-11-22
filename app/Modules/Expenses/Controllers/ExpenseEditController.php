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
use FI\Modules\Expenses\Repositories\ExpenseRepository;
use FI\Modules\Expenses\Validators\ExpenseValidator;
use FI\Support\BackPath;

class ExpenseEditController extends Controller
{
    public function __construct(
        ExpenseRepository $expenseRepository,
        ExpenseValidator $expenseValidator
    )
    {
        parent::__construct();

        $this->expenseRepository = $expenseRepository;
        $this->expenseValidator  = $expenseValidator;
    }

    public function edit($id)
    {
        return view('expenses.form')
            ->with('editMode', true)
            ->with('expense', $this->expenseRepository->find($id));
    }

    public function update($id)
    {
        $validator = $this->expenseValidator->getValidator(request()->all());

        if ($validator->fails())
        {
            return redirect()->route('expenses.edit', [$id])
                ->withErrors($validator)
                ->withInput();
        }

        $this->expenseRepository->update(request()->all(), $id);

        return redirect()->to(BackPath::getBackPath('expenses'))
            ->with('alertSuccess', trans('fi.record_successfully_updated'));
    }
}