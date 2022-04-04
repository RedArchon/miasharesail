<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoListStoreRequest;
use App\Models\TodoItem;
use App\Models\TodoList;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use JetBrains\PhpStorm\NoReturn;

class TodoListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {

        return Inertia::render('TheTodoListIndexComponent', ['lists' => TodoList::byUserType()->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('TheCreateTodoListComponent');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TodoListStoreRequest $request
     * @return JsonResponse
     */
    public function store(TodoListStoreRequest $request): JsonResponse
    {
        $this->storeNewListViaTransaction($request);

        return response()->json(['data' => TodoList::create($request->validated()), 'status' => 201]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Inertia\Response
     */
    public function show($id): \Inertia\Response
    {
        return Inertia::render('TodoListShowComponent', ['list' => TodoList::whereId($id)->first()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @param TodoListStoreRequest $request
     * @return void
     */
    private function storeNewListViaTransaction(TodoListStoreRequest $request): void
    {
        DB::transaction(function () use ($request) {
            $list = TodoList::create($request->validated());
            $this->createItemsForNewList(collect($request->validated('items')), $list);
        });
    }

    /**
     * @param $items
     * @param $list
     * @return void
     */
    private function createItemsForNewList($items, $list): void
    {
        $items->each(function ($item) use ($list) {
            TodoItem::make($item)->list()->associate($list)->save();
        });
    }
}
