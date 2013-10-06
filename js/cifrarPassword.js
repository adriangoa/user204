function cifrar(){
    var input_pass =$("#password");
    input_pass.val(sha1(input_pass.val()));  
}
