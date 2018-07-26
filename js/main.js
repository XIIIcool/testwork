$(document).ready(function(){
	//sign-up tabs

	if($('.list-tabs').length) {
		$('.list-tabs a').click(function (e) {
			e.preventDefault();
			$(this).tab('show');
			$('.list-tabs a').parent("li").removeClass("active");
			$(this).parent("li").addClass("active");
		})
	}

	//Категории рубрик
	function formatState (state) {
		//var parentHeadings = ["Родительская категория1", "Родительская категория2"]; //массив категорий для вывода в селект
               
		if (!state.id) {
		  return state.text;
		}
		var $state = $(
		  '<span>' + state.text + ' <span class="parents">/ ' + state.parent1name + ',&nbsp;' + state.parent2name + '</span>' + '</span>'
		);
		return $state;
	};
	
	//select2
	if($(".select2").length) {
		$(".select2").select2({
			language: "ru",
			placeholder: "Выберите рубрику",
			closeOnSelect: false,
			multiple: true,
                        minimumInputLength: 3,
			templateResult: formatState,
                        
                           ajax: {
                            url: 'ajax.php',
                            dataType: 'json',
                              delay: 250,
                              data: function (params) {
                                return {
                                  name: params.term,
                                  method: 'getCategories'
                                };
                              },
                              processResults: function (data, params) {

                                var data = $.map(data, function (obj) {
                                  obj.text = obj.name ; // replace name with the property used for the text

                                  return obj;
                                });     

                              

                                return {
                                  results: data

                                };
                              },
                              cache: true
                            },
                        
		});
	}
        

        $('#customer-town, #doer-town').select2({
            ajax: {
              url: 'ajax.php',
              dataType: 'json',
                delay: 250,
                data: function (params) {
                  return {
                    city: params.term, // search term
                    method: 'getCity'
                  };
                },
                processResults: function (data, params) {
                       
                  var data = $.map(data, function (obj) {
                    obj.text = obj.text + ' ' + obj.name ; 

                    return obj;
                  });     
                       
         
               
                  return {
                    results: data
                  
                  };
                },
                cache: true
              },
              placeholder: 'Введите город',
              minimumInputLength: 3,
       
            });


        $('form').submit(function() {
            var form = this;
              
            var phone = $(form).find('input[type=tel]').val();
            var re = /^\d[\d\(\)\ -]{4,14}\d$/;
            var valid = re.test(phone);
            if (!valid) {
                $(form).find('input[type=tel]').next('div').html('Некоректно введён телефон');
                
                return false;
            }
            
            var str = $(this).serialize();
                 $.ajax( {
                    type: "POST",
                    url: 'ajax.php',
                    data: str,
                    success: function( response ) {
                       if(response.status == 'OK'){ 
                         $('.modal').modal('show');
                        // $(form)[0].reset();
                        }
                    }
                  } )
                return false;
            }); 
});
