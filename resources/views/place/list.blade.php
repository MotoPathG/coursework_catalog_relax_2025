<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('List') }}
        </h2>
        
    </x-slot>

    <div class="py-12">
        <table class="table table-striped table-sm">
            <thead>
              <tr>
                <th scope="col">Фото</th>
                <th scope="col">Сотрудник</th>
                <th scope="col">ЗП</th>
                <th scope="col">Действия</th>
              </tr>
            </thead>
            <tbody id="tbody_users_wages">
              <!--Add Use Js and Ajax -->
            </tbody>
        </table>
        <div>data</div>
        <div>{{$places}}</div>
    </div>

    <script type="text/javascript">
      let _token = $('meta[name="csrf-token"]').attr('content');

      var data = {
        //lastname: "James",
        //firstname: "Smith",
        //nickname: "programmer",
        wages: {
          max: 0,
        },
    }
        
    /*
      $('#modal_wages_user_update').on('hide.bs.modal', function (e) { 
        var tmpid = $(document.activeElement).attr('id');
        if(tmpid=='modal_wages_user_update_btn') WagesUpdateUserAction();
      });

      function GetUserList()
      {
        $.ajax({
              async: true,
              url: '../../../api/work/wages',
              type: 'get', 
              dataType: 'json',          /* Тип данных в ответе (xml, json, script, html). */        /*
              data: {
                _token: _token,
              },
              success: function(result)
              {
                result.forEach(element => {
                  AddWagesToTable(element);
                });
              },
              error: function(data)
              {
                  var obj = JSON.parse(data);
                  alert(obj["err"]);
                  alert(data);
              }
          });
      }
      
      function WagesUpdateUserAction(){
        var modalUserId = document.getElementById('modal_wages_update_user_id');
        var modalType = document.getElementById('modal_wages_update_money_history_type');
        var modalMoney = document.getElementById('modal_wages_update_money_value');
        var modalReason = document.getElementById('modal_wages_update_money_reason_value');
        var modalDetals = document.getElementById('modal_wages_update_user_detals');

        $.ajax({
              async: true,
              url: '../../../api/work/wages/'+modalUserId.value,
              type: 'put', 
              dataType: 'json',
              data: {
                _token: _token,
                type: modalType.value,
                money: modalMoney.value,
                history:{
                  reason: modalReason.value,
                  detals: modalDetals.value,
                }
              },
              success: function(result)
              {
                  AddWagesToTable(result);
              },
              error: function(data)
              {
                  var obj = JSON.parse(data);
                  alert(obj["err"]);
                  alert(data);
              }
        });
      }

      function AddWagesToTable(data)
      {
        var table = document.getElementById('tbody_users_wages');

        var tr_create = document.getElementById('tr_wages_user_id_'+data.user_id);

          var userImage = "";
          var userWorkFromDateTimeText = "-";
          var userWorkToDateTimeText = "-";

          if(data.user.profile_img_url)
          {
            userImage = '<img src="'+data.user.profile_img_url+'" style="height: 200px;"/>';
          }

          var tr_innerHTMLValue =
            '<td>'+userImage+'</td>'+
            '<td>'+getUserName(data.user)+'</td>'+
            '<td>'+data.money+'</td>'+
            '<td class="col-3">'+
                '<button class="btn btn-info m-1" role="button" id="btn_for_update_money_user_'+data.user.id+'" data-bs-toggle="modal" data-bs-target="#modal_wages_user_update">Измененить</button>'+
                '<button class="btn btn-info m-1" role="button" id="btn_for_get_history_user_'+data.user.id+'">История</button>'+
            '</td>';

          if(tr_create)
          {
            tr_create.innerHTML = tr_innerHTMLValue;
          }
          else
          {
              //Теперь создаем строку и присваиваем ее переменной.
              var tr = document.createElement("tr");
              tr.id = "tr_wages_user_id_"+data.user_id;
              tr.innerHTML = tr_innerHTMLValue;
              //вставляем строку в таблицу
              table.appendChild(tr);
          }

          //
          var buttonForUpdateMoney = document.getElementById('btn_for_update_money_user_'+data.user.id);
          var buttonForGetHistory = document.getElementById('btn_for_get_history_user_'+data.user.id);

          var modalMaxMoneyAdd = document.getElementById('modal_wages_money_max_add_btn');
          var modalMaxMoneyValue = document.getElementById('modal_wages_user_money_value_max');
          var modalTitle = document.getElementById('modal_wages_user_update_label');

          var modalLastname = document.getElementById('modal_wages_user_update_data_lastname');
          var modalFirstname = document.getElementById('modal_wages_user_update_data_firstname');
          var modalNickname = document.getElementById('modal_wages_user_update_data_nickname');
          
          var modalUserId = document.getElementById('modal_wages_update_user_id');

          
          if(buttonForUpdateMoney) {
            buttonForUpdateMoney.addEventListener('click', function() {
              modalUserId.value=data.user.id;
              user.wages.max = data.money;
              modalTitle.innerHTML = 'Изменение зарплаты у ' + getUserName(data.user);
              modalMaxMoneyAdd.innerHTML=data.money +" руб.";
              modalMaxMoneyValue.innerHTML=data.money +" руб.";

              if(data.user.lastname) modalLastname.innerHTML = data.user.lastname; 
              else modalLastname.innerHTML = "-";
              if(data.user.firstname) modalFirstname.innerHTML = data.user.firstname;
              else modalFirstname.innerHTML = "-";
              if(data.user.nickname) modalNickname.innerHTML = data.user.nickname;
              else modalNickname.innerHTML = "-";
              
            });
          }
          if(buttonForGetHistory)
          {
            buttonForGetHistory.addEventListener('click', function() {
                GetHistoryUseIdFunction(data.user.id);
            });
          }
          
      }

      function ModalMoneyUpdateFunction(moneyValue){
        document.getElementById('modal_wages_update_money_value').value=limitNumberWithinRange(moneyValue, 0, user.wages.max);
      }
      
      function GetHistoryUseIdFunction(user_id){
        window.open("../dashboard/wages/history?user_id="+user_id, "_self")
      }

      function limitNumberWithinRange(num, min, max){
        const MIN = min ?? 0;
        const MAX = max ?? 10000;
        const parsed = parseInt(num)
        return Math.min(Math.max(parsed, MIN), MAX)
      }

      function getUserName(data){
          var usernameValue = "";
          if(data.firstname) usernameValue += data.firstname + ' ';
          if(data.lastname) usernameValue += data.lastname;

          if(data.firstname || data.lastname)
          {
            if(data.nickname) usernameValue += ' (' + data.nickname + ')';
          }
          else{
            if(data.nickname) usernameValue += data.nickname;
          }

          return usernameValue;
      }
          */
    </script>
</x-app-layout>
