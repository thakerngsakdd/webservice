$(document).ready(function() {
    $("#Formregister").validate({
        rules: {
            fname: "required", // id  fname
            lname: "required",
            user: "required",
            email: {
                required: true,
                email: true
            },
            phone: {
                required: true,
                number: true
            },
            password1: {
                required: true,
                minlength: 6
            },
            password2: {
                required: true,
                minlength: 6,
                equalTo: "#password1"
            }
        },
        messages: {
            fname: "* โปรดกรอกชื่อ",
            lname: "* โปรดกรอกนามสกุล",
            user: "* โปรกรอกชื่อผู้ใช้งาน",
            email: {
                required: "* โปรดกรอกEmail",
                email: "* โปรดกรอก Email ให้ถูกต้อง"
            },
            phone: {
                required: "* โปรดกรอกเบอร์โทร",
                number: "* โปรดกรอก เบอร์โทร ให้ถูกต้อง"
            },
            password1: {
                required: "* โปรดกรอก รหัสผ่าน",
                minlength: "* โปรดกรอกข้อมูล ไม่น้อยกว่า 6-20 ตัวอักษร"
            },
            password2: {
                required: "* โปรดกรอก รหัสผ่าน",
                minlength: "* โปรดกรอกข้อมูล ไม่น้อยกว่า 6-20 ตัวอักษร",
                equalTo: "* โปรดกรอกรหัสผ่านให้ตรงกัน"
            }
        },

        errorElement: "div",
        errorPlacement: function(error, element) {
            error.addClass("invalid-feedback");
            error.insertAfter(element);
        },
        highlight: function(element, error, validClass) {
            $(element)
                .addClass("is-invalid")
                .removeClass("is-valid");
        },
        unhighlight: function(element, error, validClass) {
            $(element)
                .addClass("is-valid")
                .removeClass("is-invalid");
        }
    });
});

$(document).ready(function() {
    $("#Formupdatauser").validate({
        rules: {
            fname: "required", // id  fname
            lname: "required",
            email: {
                required: true,
                email: true
            },
            phone: {
                required: true,
                number: true
            }
        },
        messages: {
            fname: "* โปรดกรอกชื่อ",
            lname: "* โปรดกรอกนามสกุล",

            email: {
                required: "* โปรดกรอกEmail",
                email: "* โปรดกรอก Email ให้ถูกต้อง"
            },
            phone: {
                required: "* โปรดกรอกเบอร์โทร",
                number: "* โปรดกรอก เบอร์โทร ให้ถูกต้อง"
            }
        },

        errorElement: "div",
        errorPlacement: function(error, element) {
            error.addClass("invalid-feedback");
            error.insertAfter(element);
        },
        highlight: function(element, error, validClass) {
            $(element)
                .addClass("is-invalid")
                .removeClass("is-valid");
        },
        unhighlight: function(element, error, validClass) {
            $(element)
                .addClass("is-valid")
                .removeClass("is-invalid");
        }
    });
});

$(document).ready(function() {
    $("#Formupdatapassword").validate({
        rules: {
            password: "required", // id  fname
            password1: {
                required: true,
                minlength: 6
            },
            password2: {
                required: true,
                minlength: 6,
                equalTo: "#password1"
            }
        },
        messages: {
            password: "* โปรดกรอกรหัสผ่านปัจจุบัน",
            password1: {
                required: "* โปรดกรอก รหัสผ่าน",
                minlength: "* โปรดกรอกข้อมูล ไม่น้อยกว่า 6-20 ตัวอักษร"
            },
            password2: {
                required: "* โปรดกรอก รหัสผ่าน",
                minlength: "* โปรดกรอกข้อมูล ไม่น้อยกว่า 6-20 ตัวอักษร",
                equalTo: "* โปรดกรอกรหัสผ่านให้ตรงกัน"
            }
        },

        errorElement: "div",
        errorPlacement: function(error, element) {
            error.addClass("invalid-feedback");
            error.insertAfter(element);
        },
        highlight: function(element, error, validClass) {
            $(element)
                .addClass("is-invalid")
                .removeClass("is-valid");
        },
        unhighlight: function(element, error, validClass) {
            $(element)
                .addClass("is-valid")
                .removeClass("is-invalid");
        }
    });
});

$(document).ready(function() {
    $("#addtype").validate({
        rules: {
            typeproduct: "required" // id  fname
        },
        messages: {
            typeproduct: "โปรดกรอกชื่อประเภทสินค้า"
        },

        errorElement: "div",
        errorPlacement: function(error, element) {
            error.addClass("invalid-feedback");
            error.insertAfter(element);
        },
        highlight: function(element, error, validClass) {
            $(element)
                .addClass("is-invalid")
                .removeClass("is-valid");
        },
        unhighlight: function(element, error, validClass) {
            $(element)
                .addClass("is-valid")
                .removeClass("is-invalid");
        }
    });
});

function recaptChcallback() {
    $("#submitRegister").removeAttr("disabled");
}



$(".profile-input").on("change", function() {
    // เปลี่ยนรูปโปรไฟล์ใหม่ custom-file-input
    /* console.log(
      $(this)
        .val()
        .split("\\")
        .pop()
    );*/

    var filename = $(this)
        .val()
        .split("\\")
        .pop();
    $(this)
        .siblings(".custom-file-label") /// แก้ตรงนี้
        .html(filename);

    if (this.files[0]) {
        var reader = new FileReader();
        $(".figure").addClass("d-block");
        reader.onload = function(e) {
            //console.log(reader);
            $("#imgprofile")
                .attr("src", e.target.result)
                .width(240)
                .height(200);
        };
        reader.readAsDataURL(this.files[0]);
        $("#submitphoto").removeAttr("disabled");
    }
});

$(".product-file").on("change", function() {
    //เพิ่มรูปสินค้า ตลาส product-file-input
    /* console.log(
      $(this)
        .val()
        .split("\\")
        .pop()
    );*/

    var filename = $(this)
        .val()
        .split("\\")
        .pop();
    $(this)
        .siblings(".product-label") /// แก้ตรงนี้
        .html(filename);

    if (this.files[0]) {
        var reader = new FileReader();
        $(".figure").addClass("d-block");
        reader.onload = function(e) {
            //console.log(reader);
            $("#imgproduct")
                .attr("src", e.target.result)
                .width(800)
                .height(600);
        };
        reader.readAsDataURL(this.files[0]);
        $("#submitproduct").removeAttr("disabled");
    }
});

$(".updateimgproduct-input").on("change", function() {
    // เปลี่ยนรูปโปรไฟล์ใหม่ custom-file-input
    /* console.log(
      $(this)
        .val()
        .split("\\")
        .pop()
    );*/

    var filename = $(this)
        .val()
        .split("\\")
        .pop();
    $(this)
        .siblings(".custom-file-label") /// แก้ตรงนี้
        .html(filename);

    if (this.files[0]) {
        var reader = new FileReader();
        $(".figure").addClass("d-block");
        reader.onload = function(e) {
            //console.log(reader);
            $("#imgprofile")
                .attr("src", e.target.result)
                .width(800)
                .height(600);
        };
        reader.readAsDataURL(this.files[0]);
        $("#submitphotoproduct").removeAttr("disabled");
    }
});

$(document).ready(function() {
    //สินค้า
    /*
    $("#add").click(function() {
      $("#insert").val("Insert");
      $("#insert_form")[0].reset();
    });
    */

    $(document).on("click", ".edit_dataproduct", function() {
        // เรียกฟอมมาแก้ไข
        var Menu_ID = $(this).attr("id");
        $.ajax({
            url: "phpsql/fetch.php",
            method: "POST",
            data: {
                Menu_ID: Menu_ID //  ชื่อโพส
            },
            dataType: "json",

            success: function(data) {
                //$('#name').val(data.Product_Name);
                //var x = data.Product_Price;
                //document.write(x);
                // $("#nameproduct2").val(data.Product_Name);

                // $("#typeproduct2").val(data.Type_ID);

                // $("#price2").val(data.Product_Price);
                // $("#unit2").val(data.Product_Balance);
                // $("#warrantyproduct2").val(data.Warranty_ID);
                // $("#warrantyproduct3").val(data.Warranty_ID);
                // $("#detail2").val(data.Product_Details);
                // //$('#detail2').val(data.product_ID);
                // //$('#age').val(Product_Photo);
                // $("#idproduct").val(data.Product_ID);
                // $("#idproduct-one").val(data.Product_ID);
                // //$("#product_ID3").val(data.Product_ID);
                // $("#typeproduct3").val(data.Type_ID);
                // $("#idproduct3").val(data.Type_ID);
                /*
                    Menu_Calorie: "120"
                    Menu_ID: "184"
                    Menu_Name: "แกงส้ม"
                    Menu_Photo: "9267327628988.jpg"
                    Rest_Name: "ข้าวสวยแฟม"  
                    Categories_ID  
                */

                $("#Menu_ID").val(data.Menu_ID);
                $("#Menu_Name").val(data.Menu_Name);
                $("#Menu_Calorie").val(data.Menu_Calorie);
                $("#Menu_Photo").val(data.Menu_Photo);
                $("#Rest_Name").val(data.Rest_Name);
                $("#Categories_ID").val(data.Categories_ID);
                $("#Menu_Price").val(data.Menu_Price);
                $("#Menu_Details").val(data.Menu_Details);




                $("#insert").val("อัพเดท"); // แก้ตรงนี้
                $("#add_dataproduct_Modal").modal("show");

            }
        });
    });

    $(document).on("click", ".view_dataproduct", function() {
        // เรียกดูข้อมูล
        var Menu_ID = $(this).attr("id");
        if (Menu_ID != "") {
            $.ajax({
                url: "phpsql/select.php",
                method: "POST",
                data: {
                    Menu_ID: Menu_ID
                },
                success: function(data) {
                    $("#detailproduct").html(data);
                    $("#dataModal").modal("show");
                }
            });
        }
    });
}); //สินค้า

$(document).ready(function() {
    $("#add").click(function() {
        $("#insert").val("Insert");
        $("#insert_form")[0].reset();
    });

    $(document).on("click", ".edit_data", function() {
        // เรียกฟอมมาแก้ไข
        var Categories_ID = $(this).attr("id");
        $.ajax({
            url: "phpsql/fetch.php",
            method: "POST",
            data: {
                Categories_ID: Categories_ID //  ชื่อโพส
            },
            dataType: "json",
            success: function(data) {
                // $("#name").val(data.Type_Name);
                $("#Categories_name").val(data.Categories_Name);
                $("#Categories_id").val(data.Categories_ID);
                $("#insert").val("อัพเดท"); // แก้ตรงนี้
                $("#add_data_Modal").modal("show");
            }
        });
    });

    $("#insert_form").on("submit", function(event) {
        event.preventDefault();
        if ($("#name").val() == "") {
            alert("Name is required");
        } else {
            $.ajax({
                url: "phpsql/insert.php",
                method: "POST",
                data: $("#insert_form").serialize(),
                beforeSend: function() {
                    // แก้ตรงนี้
                    $("#insert").val("กำลังอัพเดท");
                },
                success: function(data) {
                    $("#insert_form")[0].reset();
                    $("#add_data_Modal").modal("hide");
                    $("#employee_table").html(data);
                }
            });
        }
    });

});

$(document).ready(function() {
    //`Warranty_ID`, `Warranty_Name`, `Warranty_Day`

    $(document).on("click", ".edit_data-Warranty", function() {
        // เรียกฟอมมาแก้ไข
        var Warranty = $(this).attr("id");
        $.ajax({
            url: "phpsql/fetch.php",
            method: "POST",
            data: {
                Warranty: Warranty //  ชื่อโพส
            },
            dataType: "json",
            success: function(data) {
                $("#name").val(data.Warranty_Name);
                $("#day").val(data.Warranty_Day);
                //$('#gender').val(data.gender);
                //$('#designation').val(data.designation);
                //$('#age').val(data.age);
                $("#Warrantyid").val(data.Warranty_ID);
                $("#insert").val("อัพเดท"); // แก้ตรงนี้
                $("#add_data_Modal").modal("show");
            }
        });
    });
});
//view_dataordersales
$(document).ready(function() {
    //`Warranty_ID`, `Warranty_Name`, `Warranty_Day`

    $(document).on("click", ".edit_data-Delivery", function() {
        // เรียกฟอมมาแก้ไข
        var Delivery = $(this).attr("id");
        $.ajax({
            url: "phpsql/fetch.php",
            method: "POST",
            data: {
                Delivery: Delivery //  ชื่อโพส
            },
            dataType: "json",
            success: function(data) {
                $("#Deliveryname").val(data.Delivery_Name);
                $("#Price").val(data.Delivery_Price);
                //$('#gender').val(data.gender);
                //$('#designation').val(data.designation);
                //$('#age').val(data.age);
                $("#Deliveryid").val(data.Delivery_ID);
                $("#insert").val("อัพเดท"); // แก้ตรงนี้
                $("#add_data_Modal").modal("show");
            }
        });
    });
});

$(document).ready(function() {
    //ออเดอร์สินค้า
    /*
    $("#add").click(function() {
      $("#insert").val("Insert");
      $("#insert_form")[0].reset();
    });
    */

    $(document).on("click", ".edit_dataordersalesTransfermoney", function() {
        // เรียกฟอมมาแก้ไข
        var ordersalesid = $(this).attr("id");
        $.ajax({
            url: "phpsql/fetch.php",
            method: "POST",
            data: {
                ordersalesid: ordersalesid //  ชื่อโพส
            },
            dataType: "json",
            success: function(data) {
                /*
                `Ordersales_ID`, 
                `Delivery_ID`, 
                `User_ID`, 
                `Ordersales_address`,
                `Ordersales_Totalprice`,
                `Ordersales_Day`, 
                `Ordersales_Status`,
                `ordersales_photo`,
                `ordersales_Packagenumber`
                idorder
                */

                $("#mony").val(data.Ordersales_Totalprice);
                $("#idorder").val(data.Ordersales_ID);
                $("#idorder_mony").val(data.Ordersales_Totalprice);

                $("#insert").val("อัพเดท"); // แก้ตรงนี้
                $("#add_dataordersalesTransfermoney_Modal").modal("show");
                $("#typeproduct3").val(data.Type_ID);
                $("#idproduct3").val(data.Type_ID);
            }
        });
    });
    $(document).on("click", ".view_dataordersales", function() {
        // เรียกดูข้อมูล
        var ordersalesid = $(this).attr("id");
        if (ordersalesid != "") {
            $.ajax({
                url: "phpsql/select.php",
                method: "POST",
                data: {
                    ordersalesid: ordersalesid
                },
                success: function(data) {
                    $("#detailproduct").html(data);
                    $("#dataModal").modal("show");
                }
            });
        }
    });
}); //ออเดอร์สินค้า

//card index

$(document).ready(function() {
    $("#myCarousel").on("slide.bs.carousel", function(e) {
        var $e = $(e.relatedTarget);
        var idx = $e.index();
        var itemsPerSlide = 3;
        var totalItems = $(".carousel-item").length;

        if (idx >= totalItems - (itemsPerSlide - 1)) {
            var it = itemsPerSlide - (totalItems - idx);
            for (var i = 0; i < it; i++) {
                // append slides to end
                if (e.direction == "left") {
                    $(".carousel-item")
                        .eq(i)
                        .appendTo(".carousel-inner");
                } else {
                    $(".carousel-item")
                        .eq(0)
                        .appendTo($(this).find(".carousel-inner"));
                }
            }
        }
    });
});

//card index
$("#blogCarousel").carousel({
    interval: 3000
});

$("#blogCarousel2").carousel({
    interval: 3000
});