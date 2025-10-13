@extends('layout.app2')
@section('title')
   user tasks
@endsection
@section('content')
    <div class="w-full h-[88%] bg-gray-200 flex items-center justify-center">
        <div class="w-[90%] h-5/6 bg-white rounded-xl pt-3 flex flex-col items-center">
            <div class="w-[90%] h-1/5 flex justify-between items-center border-b">
                <a href="{{route('tasks.create')}}" class="px-10 py-3 rounded-xl font-light text-white bg-gray-800">add task +</a>
                <h2 class="text-xl">user tasks</h2>
            </div>
            <div class="w-[90%] h-3/5 flex flex-col justify-center">
                <table class="w-full min-h-full border border-gray-400">
                    <thead>
                    <tr class="h-12 border border-gray-400 border-b-2 border-b-gray-400">
{{--
                        <td class="text-center">delete</td>
                        <td class="text-center">update</td>
--}}
                        <td class="text-center">status</td>
                        <td class="text-center">deadline</td>
                        <td class="text-center">definition date</td>
                        <td class="text-center">admin</td>
                        <td class="text-center">description</td>
                        <td class="text-center">title</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tasks as $task)
                        <tr>
{{--
                            <td class="text-center">
                                <form action="{{route('books.destroy',compact('book'))}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="text-green-600 cursor-pointer">delete</button>
                                </form>
                            </td>
                            <td class="text-center">
                                <form action="{{route('books.edit',compact('book'))}}" method="get">
                                    @csrf
                                    <button type="submit" class="text-cyan-600 cursor-pointer">update</button>
                                </form>
                            </td>
--}}
                            <td class="text-center">
                                <form action="{{route('user.tasks.status',compact('task'))}}" method="post">
                                    @csrf
                                    @method('put')
                                    <button type="submit" class="text-red-600 cursor-pointer" {{$task->status?'':'disabled'}}>{{$task->status?'done':'didnt done'}}</button>
                                </form>
                            </td>
                            <td class="text-center">{{$task->deadline}}</td>
                            <td class="text-center">{{$task->definition_date}}</td>
                            <td class="text-center">{{$task->admin->name}}</td>
                            <td class="text-center">{{$task->description}}</td>
                            <td class="text-center">{{$task->title}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-5">{{$tasks->links()}}</div>
        </div>
@endsection
