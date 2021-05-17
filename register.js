
    $(document).ready(function () {
      $.validator.addMethod("pwcheck", function(value) 
      {
          return /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) // consists of only these
          && /[a-z]/.test(value) // has a lowercase letter
          && /\d/.test(value) // has a digit
      });
        $("form[name='register']").validate({
            // Define validation rules
            rules: {
                username: "required",
                password:
                {
                    required: true,
                    pwcheck: true,
                    minlength:8
                },
                email:
                {
                    required: true,
                    email: true

                },
                Address: "required",
                DOB: "required",
                Mobile_no : 
                {
                    required:true,
                    minlength:10,
                    maxlength:10,
                    number: true
                },
                Hobbi : "required",
                Gender : "required",
                country : "required",
                state : "required",
                city : "required"
            },
            // Specify validation error messages
            messages: 
            {
                username: "Please provid a username.",
                password: 
                {
                    required:"Please provide password",
                    pwcheck:"Please enter a valid password",
                    minlength:"Please provide minimum 8 length password"
                },
                email: 
                {
                    required: 'Please enter Email .',
                     email: 'Please enter a valid Email '
          //url: 'email already exist'
                },
                Address : "Please provide Address",
                DOB : "Please provide DOB",
                Mobile_no :
                {
                    required:"Please provide mob no",
                    minlength:"Please provide valid mobile no",
                    maxlength:"Please provide valid mobile no",
                    number: "Please provide valid mobile no"
                },
                Hobbi : "Please select hobbies",
                Gender : "Please select a gender",
                country : "Please select a country",
                state : "Please select a state",
                city : "Please select a city"
            },
            errorPlacement: function(error, element) 
            {
                  if (element.attr('type') == 'radio' || element.attr('type') == 'checkbox') 
                  {
                    
                      error.insertAfter(element.parent().parent());
                  }
                  else 
                  {
                      error.insertAfter(element);
                  }


            },
            submitHandler: function (form) {
                form.submit();
            }
            
        });
    }); 
