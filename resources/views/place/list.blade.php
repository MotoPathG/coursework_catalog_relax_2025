<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
          Список всех доступных мест
        </h2>
        
    </x-slot>

    <div class="py-12 place_list">
      @foreach ($places as $place )
        <a class="place_item p-2" href="/places/{{$place->id}}">

          <!-- Верх -->
          <div class="place_item_up">
          <!-- Левый бок -->
            <div>
              @foreach ($place->images as $ivalue)
                @if($ivalue->is_main)
                  <img src="{{$ivalue->image_url}}" alt = "{{$ivalue->alt_text}}"/>
                @endif
              @endforeach
              
            </div>
            <!-- Правый бок -->
            <div>
              <p>Рейтинг - {{$place->rating}}</p>
              <p>Цена - {{$place->price_range}}<p>
            </div>
          </div>

            <!-- Низ -->
          <div class="place_item_down">
              <p>{{$place->name}}</p>
              <p>{{$place->description}}</p>
          </div>
        </a>
      @endforeach
    </div>

    <script type="text/javascript">
      let _token = $('meta[name="csrf-token"]').attr('content');
    </script>
</x-app-layout>
