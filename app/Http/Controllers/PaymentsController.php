<?php

namespace App\Http\Controllers;

use App\PaymentMode;
use App\Payment;
use App\Http\Requests\StorePayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App;
use PDF;
use Yajra\Datatables\Facades\Datatables;

class PaymentsController extends Controller
{
	public function index()
	{
		return view('payment/payment_so');
	}
	public function show(Request $request, $id)
	{
		$pays = DB::table('consignee_service_order_headers')
		->join('consignee_service_order_details', 'consignee_service_order_headers.id', '=', 'consignee_service_order_details.so_headers_id')
		->join('consignees', 'consignee_service_order_headers.consignees_id','=','consignees.id')
		->join('service_order_types', 'consignee_service_order_details.service_order_types_id', '=', 'service_order_types.id')
		->select('consignee_service_order_headers.id', 'companyName', 'service_order_types.name', 'address')
		->where('consignee_service_order_headers.id', '=', $id)
		->get();

		$rev = DB::table('billing_revenues')
		->join('billings', 'billing_revenues.bill_id', '=', 'billings.id')
		->select(DB::raw('CONCAT(SUM(amount)) as Total'))
		->where('billing_revenues.bi_head_id','=', $id)
		->get();

		$exp = DB::table('billing_expenses')
		->join('billings', 'billing_expenses.bill_id', '=', 'billings.id')
		->select(DB::raw('CONCAT(SUM(amount)) as Total'))
		->where('billing_expenses.bi_head_id','=', $id)
		->get();


		$so_head_id = $id;
		return view('payment/payment_index', compact(['pays', 'so_head_id', 'exp', 'rev']));

	}
	public function payments_table(Request $request, $id)
	{
		$rev = DB::table('billing_revenues')
		->join('billings', 'billing_revenues.bill_id', '=', 'billings.id')
		->select('name','amount')
		->where('billing_revenues.bi_head_id','=', $id);

		$exp = DB::table('billing_expenses')
		->join('billings', 'billing_expenses.bill_id', '=', 'billings.id')
		->select('name','amount')
		->where('billing_expenses.bi_head_id','=', $id)
		->union($rev)
		->get();
		return Datatables::of($exp)
		->make(true);
	}
	public function store(StorePayment $request)
	{
		$new_payment = new Payment;

		$new_payment->amount = $request->amount;
		$new_payment->so_head_id = $request->so_head_id;
		$new_payment->save();
	}
	public function payment_pdf(Request $request, $id)
	{
		$payments = DB::table('consignee_service_order_headers')
		->join('consignee_service_order_details', 'consignee_service_order_headers.id', '=', 'consignee_service_order_details.so_headers_id')
		->join('consignees', 'consignee_service_order_headers.consignees_id','=','consignees.id')
		->join('service_order_types', 'consignee_service_order_details.service_order_types_id', '=', 'service_order_types.id')
		->select('consignee_service_order_headers.id', 'companyName', 'service_order_types.name', 'address')
		->where('consignee_service_order_headers.id', '=', $id)
		->get();
		$pdf = PDF::loadView('pdf_layouts.payment_receipt', compact('payments'));
		return $pdf->stream();
	}
}
