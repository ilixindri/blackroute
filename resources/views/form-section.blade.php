@php Log::debug('line 1 in form-section') @endphp
@php Log::debug($object) @endphp
@if(empty($object))
    @php unset($object); @endphp
@endif
<div class="px-4 py-5 bg-white sm:p-6 shadow {{ isset($actions1) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
    <div class="grid grid-cols-6 gap-6">
        @php $displayable = []; @endphp
	
       @foreach($form['fields'] as $field) 
            @php $field__datas = $Model2->{$field.'__datas'}; @endphp
            @php try { $type = $field__datas["type"]; } catch (exception $e) { $type = $field__datas[0]; } @endphp
            @php Log::debug('line 16 in form-section') @endphp
            @php try {
		 if ($type == "text" or $type == 'number' or $type == "email" or $type == "date" or $type == "tel") { @endphp
            @php Log::debug('line 22 in form-section') @endphp
        @include('elements.input_element')
            @isset($field__datas['type'])
                    @isset($object)
                        @php Log::debug('line 37 in form-section') @endphp
                        @include('elements.input_element')
                    @endisset
            @endisset

            @php } else if ($Model2->{$field.'__datas'}["type"] == "select") { @endphp
            	@php Log::debug('line 25 in form-section') @endphp
                @php Log::debug('line 27 in form-section') @endphp
		@if(isset($field__datas['multipe']))
		            @php Log::debug('line 29 in form-section') @endphp
                @php $Aux = '\App\Models\\'.$field__datas['multiple']; $selects = $Aux::where(substr($route, 0, -1).'_id', $object->id)->get() @endphp
                @forelse($selects as $key2 => $select)
                    @include('elements.select')
                    @empty
                    @php unset($key2); unset($select); @endphp @include('elements.select')
                    @isset($object)
                    @endforelse
                @else
                    @php Log::debug('line 37 in form-section') @endphp
                    @include('elements.select')
                @endisset
                @php Log::debug('line 41 in form-section') @endphp
                @include('elements.select')
		@endif
            @php Log::debug('line 44 in form-section') @endphp
            @php $displayable[] = $field; }   } catch (exception $e) { //echo $e->getTraceAsString(); echo $e->getMessage();
                } @endphp

        @endforeach
        @php Log::debug('line 47 in form-section') @endphp
    </div>
</div>

@php Log::debug('line 50 in form-section') @endphp
