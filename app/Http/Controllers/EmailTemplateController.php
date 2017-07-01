<?php

namespace App\Http\Controllers;

use App\Classes\Reply;
use App\Http\Requests\EmailTemplates\IndexRequest;
use App\Http\Requests\EmailTemplates\UpdateRequest;
use App\Models\EmailTemplate;
use Datatables;

class EmailTemplateController extends UserBaseController
{

    /**
     * EmailTemplateController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = trans('menu.emailTemplates');
    }

    /**
     * Display a listing of the resource.
     * @param IndexRequest $request
     * @return \Illuminate\Contracts\View\View
     */

    public function index(IndexRequest $request)
    {
        return \View::make('admin.email-templates.index', $this->data);

    }

    /**
     * @return mixed
     */
    public function getEmailTemplate()
    {
        $emailTemplate = EmailTemplate::select('id', 'email_id', 'subject', 'body');

        $data = Datatables::of($emailTemplate)
            ->addColumn(
                'action',
                function($row) {
                    // Edit Button
                    $class = $this->global->theme_folder == 'admin-lte' ? 'bg-' : '';
                    $string = '<a style="margin: 1px;" href="javascript:;" onclick="editModal('.$row->id.')" class="btn btn-sm btn-info '.$class.'purple"><i class="fa fa-edit"></i> Edit</a> ';
                    return $string;
                }
            )
            ->removeColumn('id')
            ->make(true);
        return $data;

    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit($id)
    {
        $this->iconEdit = 'pencil';
        $this->editTemplate = EmailTemplate::find($id);
        $emailVariable = json_decode($this->editTemplate->variables);

        $this->emailVariables = isset($emailVariable) ? implode(', ', $emailVariable) : 'No Variables used';
        // Call the same create view for edit
        return \View::make('admin.email-templates.create_edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateRequest $request
     * @param $id
     * @return array
     */
    public function update(UpdateRequest $request, $id)
    {
        $emailTemplate = EmailTemplate::find($id);

        $emailTemplate->body = $request->body;
        $emailTemplate->subject = $request->subject;
        $emailTemplate->save();

        return Reply::success('messages.updateSuccess');
    }

}
