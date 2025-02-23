<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{$place->name}}
        </h2>
        
    </x-slot>

    <div class="py-12 place_show">
      <!-- Фото -->
      <div>
        @foreach ($place->images as $ivalue)
          @if($ivalue->is_main)
            <img src="{{$ivalue->image_url}}" alt = "{{$ivalue->alt_text}}"/>
          @endif
        @endforeach
      </div>
      <!-- Низ -->
      <div>
        <p>
          @foreach ($place->types as $tvalue)
            {{$tvalue->name}}</br>
          @endforeach
        </p>
        <p>{{$place->name}}</p>
        <p>Описание:</br>{{$place->description}}</p>
      </div>

      <!-- Низ -->
      <div>
        <p>Находится в городе {{$place->city}}.</p>
        <p>Текущий рейтинг [{{$place->rating}}]</p>
        <p>Ценовая категория [{{$place->price_range}}]</p>
      </div>
    </div>
    <script type="text/javascript">
      let _token = $('meta[name="csrf-token"]').attr('content');
    </script>
</x-app-layout>
