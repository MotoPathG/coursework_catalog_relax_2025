<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
          Список всех доступных мест
        </h2>
        <button class="btn btn-info my-2" role="button" data-bs-toggle="modal" data-bs-target="#add_place">Создать новое место</button>                
    </x-slot>

    <div class="py-12 place_list" id="place_list">
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
            <!-- Низ -->
            <div class="place_item_down">
              <div>
                <p>{{$place->name}}</p>
                <p>{{$place->description}}</p>
              </div>
              <div>
                <p>Рейтинг - {{$place->rating}}</p>
                <p>Цена - {{$place->price_range}}<p>
              </div>
            </div>
          </div>
        </a>
      @endforeach
    </div>

    <!--Add Modal -->
    <div class="modal fade" id="add_place" tabindex="-1" aria-labelledby="add_place_arial">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="add_place_arial">Создание нового места</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body row g-3">
              <div class="col-md-12">
                <label for="place_create_name" class="form-label">Название</label>
                <input type="text" class="form-control" id="place_create_name" value="" required>
              </div>
              
              <div class="col-md-4">
                <label for="place_create_type" class="form-label">Тип</label>
                <select class="form-select" id="place_create_type" required>
                  @foreach ($types as $value)
                    <option value="{{$value->id}}">{{$value->name}}</option>
                  @endforeach
                </select>
              </div>
              
              <div class="col-md-3">
                <label for="place_create_price" class="form-label">Цена</label>
                <select class="form-select" id="place_create_price" required> 
                  <option value="$">$</option>
                  <option value="$$">$$</option>
                  <option value="$$$">$$$</option>
                  <option value="$$$$">$$$$</option>
                  <option value="$$$$$">$$$$$</option>
                </select>
              </div>

              <div class="col-md-3">
                <label for="place_create_rating" class="form-label">Рейтинг</label>
                <select class="form-select" id="place_create_rating" required>
                  <option value="*">*</option>
                  <option value="**">**</option>
                  <option value="***">***</option>
                  <option value="****">*****</option>
                  <option value="*****">*****</option>
                </select>
              </div>
              
              <div class="col-md-6">
                <label for="place_create_latitude" class="form-label">Широта</label>
                <input type="text" class="form-control" id="place_create_latitude" value="" required>
              </div>
              <div class="col-md-6">
                <label for="place_create_longitude" class="form-label">Долгота</label>
                <input type="text" class="form-control" id="place_create_longitude" value="" required>
              </div>



              <div class="col-md-3">
                <label for="place_create_country" class="form-label">Страна</label>
                <input type="text" class="form-control" id="place_create_country" required>
              </div>
              
              <div class="col-md-3">
                <label for="place_create_region" class="form-label">Регион</label>
                <input type="text" class="form-control" id="place_create_region" required>
              </div>

              <div class="col-md-3">
                <label for="place_create_city" class="form-label">Город</label>
                <input type="text" class="form-control" id="place_create_city" required>
              </div>

              <div class="col-md-3">
                <label for="place_create_address" class="form-label">address</label>
                <input type="text" class="form-control mask-phone" id="place_create_address" required>
              </div>


              <div class="col-md-4">
                <label for="place_create_website" class="form-label">Веб-Сайт</label>
                <input type="text" class="form-control" id="place_create_website" required>
              </div>

              <div class="col-md-4">
                <label for="place_create_phone" class="form-label">Телефон</label>
                <input type="text" class="form-control" id="place_create_phone" required>
              </div>
              
              <div class="col-md-4">
                <label for="place_create_email" class="form-label">Почта</label>
                <input type="text" class="form-control" id="place_create_email" required>
              </div>

              <div class="col-md-12">
                <label for="place_create_description" class="form-label">Описание</label>
                <textarea type="text" class="form-control" id="place_create_description" required></textarea>
              </div>

              <div class="col-md-12">
                <label for="place_create_image" class="form-label">Изображение</label>
                <input type="text" class="form-control" id="place_create_image" required>
              </div>
              
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отменить</button>
            <button type="button" class="btn btn-primary"  data-bs-dismiss="modal" id="modal_place_add_btn">Создать</button>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      let _token = $('meta[name="csrf-token"]').attr('content');

      
      $('#add_place').on('hide.bs.modal', function (e) { 
        var tmpid = $(document.activeElement).attr('id');
        if(tmpid=='modal_place_add_btn') CreateNewPlace();
      });
      
      /*DEVELOPMENT NO END*/
      function CreateNewPlace(){
        var place_create_name = document.getElementById('place_create_name');
        var place_create_type = document.getElementById('place_create_type');
        var place_create_price = document.getElementById('place_create_price');
        var place_create_rating = document.getElementById('place_create_rating');
        var place_create_latitude = document.getElementById('place_create_latitude');
        var place_create_longitude= document.getElementById('place_create_longitude');
        var place_create_country = document.getElementById('place_create_country');
        var place_create_region = document.getElementById('place_create_region');
        var place_create_city = document.getElementById('place_create_city');
        var place_create_address = document.getElementById('place_create_address');
        var place_create_website = document.getElementById('place_create_website');
        var place_create_phone = document.getElementById('place_create_phone');
        var place_create_email = document.getElementById('place_create_email');
        var place_create_description = document.getElementById('place_create_description');
        var place_create_image = document.getElementById('place_create_image');

        $.ajax({
              async: true,
              url: '/places',
              type: 'post', 
              dataType: 'json',          /* Тип данных в ответе (xml, json, script, html). */        
              data: {
                _token: _token,
                name: place_create_name.value,
                type: place_create_type.value,
                price: place_create_price.value,
                rating: place_create_rating.value,
                latitude: place_create_latitude.value,
                longitude: place_create_longitude.value,
                country: place_create_country.value,
                region: place_create_region.value,
                city: place_create_city.value,
                address: place_create_address.value,
                website: place_create_website.value,
                phone: place_create_phone.value,
                email: place_create_email.value,
                description: place_create_description.value,
                image_url: place_create_image.value,
              },
              success: function(result)
              {
                UpdateList(result);
              },
              error: function(data)
              {
                  var obj = JSON.parse(data);
                  alert(obj["err"]);
                  alert(data);
              }
        });
      }

      function UpdateList(data)
      {
        var place_list = document.getElementById('place_list');
        var aElemt = document.createElement('a');
        aElemt.className = "place_item p-2";
        aElemt.href = "/places/"+data.id;
        aElemt.innerHTML =
          '<div class="place_item_up">'+
            '<div>'+
              '<img src="'+data.image+'" alt = "'+data.name+'"/>'+
            '</div>'+
            '<div>'+
              '<p>Рейтинг - '+data.rating+'</p>'+
              '<p>Цена - '+data.price_range+'<p>'+
            '</div>'+
          '</div>'+
          '<div class="place_item_down">'+
            '<p>'+data.name+'</p>'+
            '<p>'+data.description+'</p>'+
          '</div>';

        place_list.appendChild(aElemt);

      }
    </script>
</x-app-layout>
