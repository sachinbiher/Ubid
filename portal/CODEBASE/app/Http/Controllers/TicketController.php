<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CoreController;
use Illuminate\Http\Request;
use DB;
use Mail;
use View;
use Session;
use Validator;

// Models
use App\Models\User;
use App\Models\Ticket;
use App\Models\TicketComment;
use App\Models\Notifications;

// Mails
use App\Mail\ticketupdate;

class TicketController extends CoreController
{
	public $loggedInUser;
    public $data;
    public $activeMenu = 'ticket';
    public $activeSubmenu = '';

    public function __construct() {
        parent::__construct();

        $this->middleware(function ($request, $next) {
            // get current logged in user
            $this->loggedInUser = auth()->user();

            return $next($request);
        });        
    }

    public function index()
    {
        $this->data['datatable_listing'] = true;
        $this->data['dt_ordering'] = 1;
        $this->data['dt_perpage'] = Session::get('tickets_perpage', 10);
        $this->data['dt_page'] = Session::get('tickets_page', 1);
        $this->data['dt_ajax_url'] = route('ticket.getticketajaxlistdata');
        $this->data['dt_search_colums'] = ['fname','fuser','femail','fmobile','fstatus','fticket'];

        $this->data['title'] = 'Ticket Management';
        $this->data['activeMenu'] = $this->activeMenu;
        $this->data['activeSubmenu'] = $this->activeSubmenu;
        $this->data['breadcrumbs'] = (object) [
            (object) [
                'url' => false,
                'title' => 'Ticket Management',
            ],
        ];

        return view('tickets.index', $this->data);
    }
    
    public function getticketajaxlistdata(Request $request)
    {
        $columnList = [
            0 => 'user_id',
            1 => 'user_id',
            2 => 'ticket_id',
            3 => 'created_at',
            4 => 'status',
            5 => 'status',
        ];

        $order = (isset($_REQUEST['order']))?$_REQUEST['order'][0]:['column'=>1, 'dir'=>'desc'];
        $orderColumn = $columnList[$order['column']];
        $orderDir = $order['dir'];
        $iPage = (intval($request->start) / intval($request->length)) + 1;
        
        __setDatatableCurrPage('store', intval($request->length), $iPage);

        $records = [];
        $records["data"] = [];

        if (isset($request->customActionType)
            && $request->customActionType == "group_action") {
            $records["customActionStatus"] = "OK";
            $records["customActionMessage"] = "Group action successfully has been completed. Well done!";
        }

        $criteria = (object)[
            'length' => intval($request->length),
            'search' => $request->search['value'],
            // 'fname' => ($request->fname)?:null,
            'fuser' => (!is_null($request->fuser))?$request->fuser:null,
            'fticket' => (!is_null($request->fticket))?$request->fticket:null,
            'fname' => (!is_null($request->fname))?$request->fname:null,
            'femail' => (!is_null($request->femail))?$request->femail:null,
            'fmobile' => (!is_null($request->fmobile))?$request->fmobile:null,
            'fstatus' => (!is_null($request->fstatus))?$request->fstatus:null,
        ];

        $tickets = Ticket::getAjaxListData($criteria, $iPage, $orderColumn, $orderDir);
// dd($tickets);
        $iTotalRecords = $tickets->total();
        
        $iDisplayLength = intval($request->length);
        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
        $iDisplayStart = intval($request->start);
        $sEcho = intval($request->draw);

        $end = $iDisplayStart + $iDisplayLength;

        $end = $end > $iTotalRecords ? $iTotalRecords : $end;

        // $canChange = ($this->loggedInUser->hasRole('Super Admin') || $this->loggedInUser->hasRole('Admin'));

        $featuredList = [
            ["danger" => "No"],
            ["success" => "Yes"]
        ];

        $statusList = [
            ["danger" => "Open"],
            ["success" => "Resolved"],
            ["danger" => "Re-Opened"],
        ];
        foreach ($tickets as $ticket) {
// dd($ticket->user);

            // $checked = ($ticket->status=='1')?'checked':'';
            $status = $statusList[$ticket->status];
// dd($ticket->category[0]->name);
            $records["data"][] = [
                $ticket->user->user_type_id,
                '<div style="white-space: normal;word-break:break-word;">'.$ticket->user->name.'<br>'.'Email Id: '.$ticket->user->email.'<br>'.'Contact: '.$ticket->user->mobile.'</div>',
                '<div class="text-center" style="white-space: normal;word-break:break-word;">'.$ticket->ticket_id.'</div>',
                '<div class="text-center" style="white-space: normal;word-break:break-word;">'.$ticket->category[0]->name.'</div>',
                date('d M, Y', strtotime($ticket->created_at)),
                '<a class="align-items-center ticket-message" href="javascript:;" data-toggle="modal" id="'.$ticket->id.'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square font-small-4 mr-50"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                </a>',
                '<span class="badge badge-light-'.(key($status)).' badge-roundless">'.(current($status)).'</span>',
                '<a class="align-items-center" href="javascript:;" data-toggle="modal" data-target="#editDocument" data-id="'.$ticket->id.'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit font-small-4 mr-50"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                </a>'
            ];
        }

        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;

        return response()->json($records);
    }

    public function message(Request $request)
    {
        // dd(gettype($request->id));
        $this->data['ticket'] = Ticket::where('id',$request->id)->first();
        // dd(gettype($this->data['ticket']->id));
        $this->data['ticket_details'] = DB::table('tickets as t1')
                                            ->join('help_desk_comments as t2','t2.help_desk_id','t1.id')
                                            ->where('t1.id',$request->id)
                                            ->get();
        // dd($this->data['ticket']);

        return response()->json(['status'=> 200, 'result'=>$this->data['ticket']]);
    }
        

    public function changestatus(Request $request)
    {
    	$validator = Validator::make($request->all(), [
            'status' => 'required',
            'remark' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back() ->withErrors($validator) ->withInput();
        }

        DB::beginTransaction();
        try{
            Ticket::where('id', $request->ticket_id)
                    ->update([
                        'status' => $request->status,
                        'remark' => $request->remark,
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
            DB::commit();

            $ticket = Ticket::where('id', $request->ticket_id)->first();

            $status = '';
            if($ticket->status == 0){
                $status = 'Open';
            }
            elseif($ticket->status == 1){
                $status = 'Resolved';
            }
            else{
                $status = 'Re-Open';
            }

            $user = User::where('ref_id',$ticket->user_id)->first();

            $data = [
                'name' => $user->name,
                'ticket_id' => $ticket->ticket_id,
                'created_at' => date('d M, Y', strtotime($ticket->created_at)),
                'status' => $status
            ];

            $notify = new Notifications();
            $notify->title = 'Your issue has been updated.';
            $notify->content = 'UBID has updated your ticket with Ticket Id: '.$ticket->ticket_id;
            $notify->user_id = $ticket->user_id;
            $notify->notify_type = 'v';
            $notify->save();

            Mail::to($user->email)->send(new ticketupdate($data));

            return redirect()
                    ->back()
                    ->with(['toast'=>'1','status'=>'success','title'=>'Ticket','message'=>'Status updated successfully!']);
            }
        catch(Exception $e) {
            DB::rollback();
            return redirect()
                    ->back()
                    ->with(['toast'=>'1','status'=>'error','title'=>'Ticket','message'=>'Error! Some error occured, please try again!']);
        }
    }

    public function reopen(Request $request, $id)
    {

        DB::beginTransaction();
        try{
            Ticket::where('id', $id)
                    ->update([
                        'status' => 2,
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
            DB::commit();

            $ticket = Ticket::where('id', $id)->first();

            $status = 'Re-Open';

            $user = User::where('ref_id',$ticket->user_id)->first();

            $data = [
                'name' => $user->name,
                'ticket_id' => $ticket->ticket_id,
                'created_at' => date('d M, Y', strtotime($ticket->created_at)),
                'status' => $status
            ];

            $notify = new Notifications();
            $notify->title = 'Your issue has been updated.';
            $notify->content = 'UBID has updated your ticket with Ticket Id: '.$ticket->ticket_id;
            $notify->user_id = $ticket->user_id;
            $notify->notify_type = 'v';
            $notify->save();

            Mail::to($user->email)->send(new ticketupdate($data));

            return redirect()
                    ->back()
                    ->with(['toast'=>'1','status'=>'success','title'=>'Ticket','message'=>'Status updated successfully!']);
            }
        catch(Exception $e) {
            DB::rollback();
            return redirect()
                    ->back()
                    ->with(['toast'=>'1','status'=>'error','title'=>'Ticket','message'=>'Error! Some error occured, please try again!']);
        }
    }

    public function close(Request $request, $id)
    {

        DB::beginTransaction();
        try{
            Ticket::where('id', $id)
                    ->update([
                        'status' => 1,
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
            DB::commit();

            $ticket = Ticket::where('id', $id)->first();

            $status = 'Resolved';
            
            $user = User::where('ref_id',$ticket->user_id)->first();

            $data = [
                'name' => $user->name,
                'ticket_id' => $ticket->ticket_id,
                'created_at' => date('d M, Y', strtotime($ticket->created_at)),
                'status' => $status
            ];

            $notify = new Notifications();
            $notify->title = 'Your issue has been updated.';
            $notify->content = 'UBID has updated your ticket with Ticket Id: '.$ticket->ticket_id;
            $notify->user_id = $ticket->user_id;
            $notify->notify_type = 'v';
            $notify->save();

            Mail::to($user->email)->send(new ticketupdate($data));

            return redirect()
                    ->back()
                    ->with(['toast'=>'1','status'=>'success','title'=>'Ticket','message'=>'Status updated successfully!']);
            }
        catch(Exception $e) {
            DB::rollback();
            return redirect()
                    ->back()
                    ->with(['toast'=>'1','status'=>'error','title'=>'Ticket','message'=>'Error! Some error occured, please try again!']);
        }
    }

    /**
     * [Manage tickets Page View]
     * @return [type] [description]
     */
    public function editTicket(Request $request, $id)
    {
        $this->data['ticket'] = Ticket::where('id',$id)->first();
        $this->data['ticket_details'] = TicketComment::where('help_desk_id',$id)->orderBy('created_at','asc')->get();

        $this->data['seller_id'] = auth()->user()->ref_id;
        $this->data['title'] = 'Manage Ticket';
        $this->data['activeMenu'] = $this->activeMenu;
        $this->data['activeSubmenu'] = $this->activeSubmenu;

        return view('tickets.edit', $this->data);
    }
    
    /**
     * [post ticket comment]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function postComment(Request $request, $id){
        // dd($id);
        $validator = Validator::make($request->all(), [
                'sellerComment' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back() ->withErrors($validator) ->withInput();
        }

        try {
            $tblData = new TicketComment();
            $tblData->comments = $request->sellerComment;
            $tblData->comment_by = auth()->user()->ref_id;
            $tblData->help_desk_id = $id;
            
            if ($tblData->save()) {

            $ticket = Ticket::where('id', $id)->first();
            $user = User::where('ref_id',$ticket->user_id)->first();

            $status = 'Comment Posted';
            
            $data = [
                'name' => $user->name,
                'ticket_id' => $ticket->ticket_id,
                'created_at' => date('d M, Y', strtotime($ticket->created_at)),
                'status' => $status
            ];

            $notify = new Notifications();
            $notify->title = 'UBID has posted a comment addressing an issue.';
            $notify->content = 'UBID has posted a comment addressing an issue with Ticket Id: '.$ticket->ticket_id;
            $notify->notify_type = 'v';
            $notify->user_id = $ticket->user_id;
            $notify->save();

            Mail::to($user->email)->send(new ticketupdate($data));

                return redirect()->back();
            } else {
                return redirect()
                       ->back()
                        ->with(['toast'=>'1','status'=>'error','title'=>'Ticket','message'=>'Error! Some error occured, please try again.']);
            }
        } catch (Exception $e) {
            // dd($e);
            return redirect()
                        ->back()
                        ->with(['toast'=>'1','status'=>'error','title'=>'Ticket','message'=>'Error! Some error occured, please try again!']);
        }
    }
}
