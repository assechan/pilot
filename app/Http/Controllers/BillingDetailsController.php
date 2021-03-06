<?php

namespace App\Http\Controllers;

use Yajra\Datatables\Facades\Datatables;
use App\Billing;
use App\BillingRevenue;
use App\BillingExpense;
use App\Charge;
use App\BillingInvoiceHeader;
use App\ConsigneeServiceOrderHeader;
use App\Http\Requests\StoreBilling;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class BillingDetailsController extends Controller
{
	public function index()
	{
		return view('billing/bill_so_index');
	}
	public function show(Request $request, $id)
	{

		$bills = DB::table('consignee_service_order_headers')
		->join('consignee_service_order_details', 'consignee_service_order_headers.id', '=', 'consignee_service_order_details.so_headers_id')
		->join('consignees', 'consignee_service_order_headers.consignees_id','=','consignees.id')
		->join('service_order_types', 'consignee_service_order_details.service_order_types_id', '=', 'service_order_types.id')
		->select('consignee_service_order_headers.id', 'companyName', 'service_order_types.name', 'address')
		->where('consignee_service_order_headers.id', '=', $id)
		->get();

		$delivery = DB::table('delivery_billings')
		->leftjoin('charges', 'delivery_billings.charges_id', '=', 'charges.id')
		->select('charges.description', 'delivery_billings.amount')
		->where('del_head_id', '=', $id)
		->get();

		$so_head_id = $id;
		$bill_revs = DB::table('billings')
		->select('id','name')
		->where('bill_type', '=', 'R')
		->get();


		$bill_exps = DB::table('billings')
		->select('id', 'name')
		->where('bill_type', '=', 'E')
		->get();

		$vat = DB::table('vat_rates')
		->select(DB::raw('CONCAT(TRUNCATE(rate,2)) as rates'))
		->get();

		return view('billing/billing_index', compact(['bills', 'delivery', 'so_head_id', 'bill_revs', 'bill_exps', 'vat']));

	}
	public function show_billing(Request $request, $id)
	{
		$bill_revs = DB::table('billings')
		->select('id','name')
		->where('bill_type', '=', 'R')
		->get();


		$bill_exps = DB::table('billings')
		->select('id', 'name')
		->where('bill_type', '=', 'E')
		->get();


		$bills = DB::table('consignee_service_order_headers')
		->join('consignee_service_order_details', 'consignee_service_order_headers.id', '=', 'consignee_service_order_details.so_headers_id')
		->join('consignees', 'consignee_service_order_headers.consignees_id','=','consignees.id')
		->join('service_order_types', 'consignee_service_order_details.service_order_types_id', '=', 'service_order_types.id')
		->select('consignee_service_order_headers.id', 'companyName', 'service_order_types.name', 'address')
		->where('consignee_service_order_headers.id', '=', $id)
		->get();

		$so_head_id = $id;

		$vat = DB::table('vat_rates')
		->select(DB::raw('CONCAT(TRUNCATE(rate,2)) as rates'))
		->get();

		return view('billing/bills_index', compact(['vat', 'bills', 'billings','bill_counts', 'bill_revs','bill_exps', 'so_head_id']));
		
	}
	public function billing_invoice(Request $request)
	{
		$bill_hists = DB::table('billing_invoice_headers')
		->select('id', 'vatRate', 'date_billed', 'due_date')
		->where('so_head_id', '=', $request->so_head_id)
		->get();

		return Datatables::of($bill_hists)
		->addColumn('action', function ($hist) {
			return
			'<a href = "/billing/'. $hist->id .'/show_pdf" style="margin-right:10px; width:100;" class = "btn btn-md but bill_inv">View Invoice</a>';
		})
		->make(true);
		return view('billing/billing_index', compact(['billings']));
	}
	public function store(Request $request)
	{

		for($i = 0; $i<count($request->bill_id); $i++)
		{
			$bills_id = Billing::find($request->bill_id[$i]);
			if($bills_id->bill_type == 'R')
			{
				$billing_header = new BillingInvoiceHeader;
				$billing_header->so_head_id = $request->so_head_id;
				$billing_header->vatRate = $request->vatRate;
				$billing_header->date_billed = $request->date_billed;
				$billing_header->override_date = $request->override_date;
				$billing_header->due_date = $request->due_date;
				$billing_header->save();
				$billing_revenue = new BillingRevenue;
				$billing_revenue->bill_id = $request->bill_id[$i];
				$billing_revenue->description = $request->description[$i];
				$billing_revenue->amount = $request->amount[$i];
				$billing_revenue->tax = $request->tax[$i];
				$billing_revenue->bi_head_id = $request->bi_head_id;
				$billing_revenue->save();
			}
			else
			{
				$billing_header = new BillingInvoiceHeader;
				$billing_header->so_head_id = $request->so_head_id;
				$billing_header->vatRate = $request->vatRate;
				$billing_header->date_billed = $request->date_billed;
				$billing_header->override_date = $request->override_date;
				$billing_header->due_date = $request->due_date;
				$billing_header->save();
				$billing_expense = new BillingExpense;
				$billing_expense->bill_id = $request->bill_id[$i];
				$billing_expense->description = $request->description[$i];
				$billing_expense->amount = $request->amount[$i];
				$billing_expense->tax = $request->tax[$i];
				$billing_expense->bi_head_id = $request->bi_head_id;
				$billing_expense->save();
			}
		}
	}
	public function bill_pdf(Request $request, $id)
	{
		$bills = DB::table('consignee_service_order_headers')
		->join('consignee_service_order_details', 'consignee_service_order_headers.id', '=', 'consignee_service_order_details.so_headers_id')
		->join('consignees', 'consignee_service_order_headers.consignees_id','=','consignees.id')
		->join('service_order_types', 'consignee_service_order_details.service_order_types_id', '=', 'service_order_types.id')
		->join('billing_invoice_headers', 'consignee_service_order_headers.id', '=', 'billing_invoice_headers.so_head_id')
		->select('billing_invoice_headers.id','companyName','service_order_types.name', 'address','TIN', 'businessStyle', 'billing_invoice_headers.created_at')
		->where('billing_invoice_headers.id', '=', $id)
		->get();

		$billing_header =  BillingInvoiceHeader::all()->last();
		$number = $billing_header->id;
		$revenues = DB::table('billing_revenues')
		->join('billing_invoice_headers', 'billing_revenues.bi_head_id', '=', 'billing_invoice_headers.id')
		->join('billings', 'billing_revenues.bill_id', '=','billings.id')
		->select('billings.name', DB::raw('CONCAT(TRUNCATE(billing_revenues.amount - (billing_revenues.amount * billing_revenues.tax/100),2)) as Total'))
		->where('billing_revenues.bi_head_id', '=', $id)
		->get();

		$expenses = DB::table('billing_expenses')
		->join('billing_invoice_headers', 'billing_expenses.bi_head_id', '=', 'billing_invoice_headers.id')
		->join('billings', 'billing_expenses.bill_id', '=','billings.id')
		->select('billings.name', DB::raw('CONCAT(TRUNCATE(billing_expenses.amount - (billing_expenses.amount * billing_expenses.tax/100),2)) as Total'))
		->where('billing_expenses.bi_head_id', '=', $id)
		->get();

		$pdf = PDF::loadView('pdf_layouts.bill_invoice_pdf', compact(['revenues', 'expenses', 'bills', 'number']));
		return $pdf->stream();
	}

}
