<x-app-layout>

<x-slot name="header">
   <div class="flex justify-between items-center">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Current Courses') }}
        </h2>
        <div class="bg-green-500 rounded-full w-16 h-16 flex items-center justify-center">
        <a href="{{route('currentcourses.create')}}">
            <span class="text-white text-xl">+</span>
         </a>
      </div>
   </div>
</x-slot>

<x-slot name="slot">
   <div class="max-w-7xl mx-auto">
   <ul role="list" class="divide-y divide-gray-200">
      @foreach($instances as $instance)
         <li class="mt-2">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item bg-white border border-gray-200">
                <div class="accordion-header flex items-center justify-between">
                    <div class="flex items-center justify-between w-11/12" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $instance->id}}" aria-expanded="true"
                    aria-controls="collapse-{{ $instance->id}}">
                    <h2 class="mb-0 pl-4 w-full" id="heading-{{ $instance->id}}">
                        {{ $instance->course->name}} - {{ $instance->cohort->name}}
                    </h2>
                    <button class="
                    accordion-button
                    relative
                    flex
                    items-center
                    w-full
                    py-4
                    px-5
                    text-base text-gray-800 text-left
                    bg-white
                    border-0
                    rounded-none
                    transition
                    focus:outline-none
                    " type="button">
                    </button>
                    </div>
                    <div class="flex items-center ">
                    <div class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 z-10">
                        <a href="{{ route('currentcourses.edit', $instance->id ) }}">Add Sessions</a>
                    </div>
                    </div>
                </div>
                <div id="collapse-{{ $instance->id}}" class="accordion-collapse collapse" aria-labelledby="heading-{{ $instance->id}}"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body py-4 px-5">
                        <div class="table w-full">
                            <div class="thead">
                                <div class="tr">
                                    <div class="td">id</div>
                                    <div class="td">Date</div>
                                    <div class="td">Session</div>
                                    <div class="td">Trainer</div>
                                    <div class="td">Zoom Link</div>
                                    <div class="td"></div>
                                </div>
                            </div>
                            <div class="tbody">
                                @foreach($instance->sessions as $session)
                                    <form class="tr" action="{{ route('currentcourses.update', $instance->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="instance_id" value="{{ $instance->id}}" />
                                        <input type="hidden" name="instance_session_id" value="{{ $session->id}}" />
                                        <div class="td">
                                            <input
                                                type="text"
                                                disabled
                                                name="id"
                                                id="id"
                                                class="h-full w-full border-none"
                                                @if($session->id)
                                                    value="{{ $session->id}}"
                                                @endif
                                            />
                                        </div>
                                        <div class="td">
                                            <input
                                                type="date"
                                                disabled
                                                name="date"
                                                id="date"
                                                class="h-full w-full border-none"
                                                @if($session->pivot->date)
                                                    value="{{ $session->pivot->date}}"
                                                @endif
                                            />
                                        </div>

                                        <div class="td">
                                            <input
                                                type="text"
                                                id="session_name"
                                                name="session_name"
                                                disabled
                                                value="{{ $session->name}}" class="h-full border-none w-full"
                                            />
                                        </div>

                                        <div class="td">
                                            @if($session->pivot->trainer)
                                                <select
                                                    name="trainer_id"
                                                    id="trainer_id"
                                                    disabled
                                                    class="w-full h-full border-none"
                                                >
                                                    @foreach($trainers as $trainer)
                                                        <option
                                                            value="{{$trainer->id}}"
                                                            {{ $trainer->id === $session->pivot->trainer->id ? 'selected' : '' }}
                                                        >
                                                        {{ $trainer->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            @else
                                                <select
                                                    name="trainer_id"
                                                    id="trainer_id"
                                                    disabled
                                                    class="w-full h-full border-none"
                                                >
                                                    <option selected disabled>Press edit to Select</option>
                                                    @foreach($trainers as $trainer)
                                                        <option value="{{$trainer->id}}"">
                                                        {{ $trainer->name }}</option>
                                                    @endforeach
                                                </select>
                                            @endif
                                        </div>

                                        <div class="td">
                                            @if($session->pivot->zoomRoom)
                                                <input
                                                    type="text"
                                                    disabled
                                                    class="w-full h-full border-none"
                                                    value="{{ $session->pivot->zoomRoom->link}}"
                                                />
                                            @else
                                                <select
                                                    name="zoom_room_id"
                                                    id="zoom_room_id"
                                                    disabled
                                                    class="h-full w-full border-none"
                                                >
                                                    @foreach($zoom_rooms as $room)
                                                        <option value="{{$room->id}}"">
                                                        {{ $room->name }}</option>
                                                    @endforeach
                                                </select>
                                            @endif

                                        </div>

                                        <div class="td">
                                            <button class="edit-btn px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 z-10">Edit</button>
                                            <input class="h-full border-none bg-blue-500 text-white hidden" type="submit" id="submit">
                                        </div>

                                    </form>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         </li>

         @endforeach
   </ul>
   </div>
</x-slot>



</x-app-layout>


<style>
    .table
{
	display:table;
	border-collapse:collapse;
	border-spacing:2px;
}
.thead
{
	display:table-header-group;
	color:white;
	font-weight:bold;
	background-color:grey;
}
.tbody
{
	display:table-row-group;
}
.tr
{
	display:table-row;
}
.td
{
	display:table-cell;
	border:1px solid black;
	padding:1px;
}

</style>

<script>
    const editBtns = document.querySelectorAll('.edit-btn');

    editBtns.forEach(btn => {
        btn.addEventListener('click', function(e){
            e.preventDefault();
            const tr = e.target.parentElement.parentElement;
            const inputs = Array.from(tr.getElementsByTagName('input'));
            const selects = Array.from(tr.getElementsByTagName('select'))

            remove_disabled_attribute_from_inputs(inputs);
            remove_disabled_attribute_from_inputs(selects);

            const submitBtn = tr.querySelector('#submit');
            btn.classList.add('hidden');
            submitBtn.classList.remove('hidden');
        })
    })

    function remove_disabled_attribute_from_inputs(inputs){
        inputs.forEach(input => {
                if(input.type !== 'text'){
                    input.disabled = false
                }
            })
    }


</script>
