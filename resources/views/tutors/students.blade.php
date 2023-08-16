<div class="px-3 md:px-5 pt-2 pb-5">
    <div class="border-b mb-5 flex justify-between">
        <p class="font-semibold text-xl"> Association d'élèves à un parent</p>
        <button @click="show = false" class="p-2 hover:text-red-600">
            X
        </button>
    </div>
    <div>
        @if ($tutor->childreen->isNotEmpty())
        <div @if($students->isNotEmpty())class="mb-3 border-b-2 pb-3" @endif>
            <p class="font-semibold mb-1">Elèves sur sa responsabilité :</p>
            <div class="grid grid-flow-col gap-3">
                @foreach ($tutor->childreen as $key => $child)
                    <div>
                        {{ $key + 1 . '. '. $child->user->name }}
                    </div>
                @endforeach
            </div>
        </div>
        @endif
        @if ($students->isNotEmpty())
            <form method="POST" action="{{ route('tutors.students', $tutor->id) }}">
                @csrf
                <div class="mb-4">
                    <x-input-label for="students" value="L'élève ou les élèves sous sa responsabilité"/>
                    <x-selectbox id="students" class="block mt-1 w-full" name="students[]" multiple="multiple">
                        <option value=""></option>
                        @foreach ($students as $student)
                            <option value="{{ $student->id }}" >{{ $student->user->name }}</option>
                        @endforeach
                    </x-selectbox>
                    <x-input-error :messages="$errors->get('students')" class="mt-2" />
                </div>

                <div class="flex items-center justify-center mt-4">
                    <x-primary-button >
                        Valider
                    </x-primary-button>
                </div>
            </form>
        @endif
    </div>
</div>