<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoListStoreRequest;
use App\Models\TodoItem;
use App\Models\TodoList;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class TodoListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $user = auth()->user();

        if($user->hasRole('admin')){
            $lists = TodoList::with('items')->withTrashed()->get();
        }else{
            $lists = TodoList::with('items')->whereUserId($user->id)->get();
        }

        return Inertia::render('TheTodoListIndexComponent', ['lists' => $lists]);
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
        return response()->json(['list' => $this->storeNewListViaTransaction($request)], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Inertia\Response
     */
    public function show($id): \Inertia\Response
    {
        if(auth()->user()->hasRole('admin')){
            $list = TodoList::find($id);
            $list->items = $list->items()->withTrashed()->get();
        }else{
            $list = TodoList::with('items')->whereId($id)->first();
        }
        return Inertia::render('TodoListShowComponent', ['list' => $list, 'is_admin' => auth()->user()->hasRole('admin')]);
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
     * @return mixed
     */
    private function storeNewListViaTransaction(TodoListStoreRequest $request): mixed
    {
        return DB::transaction(function () use ($request) {
            $list = TodoList::create($request->validated());
            $this->createItemsForNewList(collect($request->validated('items')), $list);
            return $list;
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
