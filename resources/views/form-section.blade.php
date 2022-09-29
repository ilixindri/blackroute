@if(empty($object)) @php unset($object); @endphp @endif
<div class="px-4 py-5 bg-white sm:p-6 shadow {{ isset($actions1) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
    <div class="grid grid-cols-6 gap-6">
        @php $displayable = []; @endphp
        {{--        @foreach($Model->getFillable() as $field)--}}

{{--        @php Log::debug('-3: '.json_encode($object)); @endphp--}}
{{--        @php Log::debug('-3: '.json_encode($form['fields'])); @endphp--}}
        @foreach($form['fields'] as $field)
{{--            @php Log::debug('-2: '.json_encode($object)); @endphp--}}
{{--            @php Log::debug('-2: '. $field); @endphp--}}
            @php $field__datas = $Model2->{$field.'__datas'}; @endphp
{{--            @php Log::debug('-2: '. json_encode($field__datas)); @endphp--}}
            @php try { $type = $field__datas["type"]; } catch (exception $e) { $type = $field__datas[0]; } @endphp
            @php try { if ($type == "text" or $type == 'number' or $type == "email" or $type == "date" or $type == "tel") { @endphp
{{--            @php Log::debug('-1: '.json_encode($object)); @endphp--}}
                @include('components.input')
            @php } else if ($Model2->{$field.'__datas'}["type"] == "select") { @endphp
                @isset($field__datas['multiple'])
                    @isset($object)
                        @php Log::debug($selects->count()) @endphp
                        @php $Aux = '\App\Models\\'.$field__datas['multiple']; $selects = $Aux::where(substr($route, 0, -1).'_id', $object->id)->get() @endphp
                        @forelse($selects as $key2 => $select) @include('components.select')
                        @empty @php unset($key2); unset($select); @endphp @include('components.select') @endforelse
                    @else
                        @include('components.select')
                    @endisset
                @else
                    @include('components.select')
                @endisset
            @php $displayable[] = $field; } } catch (exception $e) { echo $e->getTraceAsString(); echo $e->getMessage(); } @endphp
        @endforeach
    </div>
</div>
