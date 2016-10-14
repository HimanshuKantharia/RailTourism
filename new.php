<?php
//http://api.railwayapi.com/between/source/st/dest/adi/date/30-09/apikey/wgfe12838/
/*

$url = "http://api.railwayapi.com/betweeen/source/st/dest/adi/date/30-09/apikey/wgfel2838/";
 $jsondata = file_get_contents('http://api.railwayapi.com/between/source/st/dest/adi/date/30-09/apikey/wgfe12838/');

 $data = json_decode($jsondata);
 echo $data->train->name;

*/












# --- ENCRYPTION ---

    # the key should be random binary, use scrypt, bcrypt or PBKDF2 to
    # convert a string into a key
    # key is specified using hexadecimal
  /*
    $key = pack('H*', "23445565865765746546465435325");
    
    # show key size use either 16, 24 or 32 byte keys for AES-128, 192
    # and 256 respectively
    $key_size =  strlen($key);
    echo "Key size: " . $key_size . "\n";
    echo "<br>";
    $plaintext = "This string was AES-256 / CBC / ZeroBytePadding encrypted.";
    echo $plaintext;
    echo "<br>";
    # create a random IV to use with CBC encoding
    $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
    
    # creates a cipher text compatible with AES (Rijndael block size = 128)
    # to keep the text confidential 
    # only suitable for encoded input that never ends with value 00h
    # (because of default zero padding)
    $ciphertext = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key,
                                 $plaintext, MCRYPT_MODE_CBC, $iv);

    # prepend the IV for it to be available for decryption
    $ciphertext = $iv . $ciphertext;
    
    # encode the resulting cipher text so it can be represented by a string
    $ciphertext_base64 = base64_encode($ciphertext);

    echo  $ciphertext_base64 . "\n";
    echo "<br>";
    # === WARNING ===

    # Resulting cipher text has no integrity or authenticity added
    # and is not protected against padding oracle attacks.
    
    # --- DECRYPTION ---
    
    $ciphertext_dec = base64_decode($ciphertext_base64);
    
    # retrieves the IV, iv_size should be created using mcrypt_get_iv_size()
    $iv_dec = substr($ciphertext_dec, 0, $iv_size);
    
    # retrieves the cipher text (everything except the $iv_size in the front)
    $ciphertext_dec = substr($ciphertext_dec, $iv_size);

    # may remove 00h valued characters from end of plain text
    $plaintext_dec = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key,
                                    $ciphertext_dec, MCRYPT_MODE_CBC, $iv_dec);
    
    echo  $plaintext_dec . "\n";

*/
?>
<!DOCTYPE html>
<html>
<head>
    <title>title</title>
    <script type="text/javascript">
        function subform()
        {
            document.grtElementById('setform').submit();
        }
        function makeDiv()
        {        
                var innerDiv = document.createElement('div');
                innerDiv.id = 'block-2';
                innerDiv.style.color='red';  
                innerDiv.style.border = "thick solid #0000FF";
                
                //innerDiv.border-width="1px solid";
                //innerDiv.border-style= "solid";

               
                var b  = document.createElement('button');
                innerDiv.appendChild(b);
                var att = document.createAttribute("id");
                att.value = "name1";
                //b.id = 'name1';
                  b.setAttributeNode(att);
                var x = b.attributes[0].value;
                document.getElementById("demo").innerHTML = x;

                var att1 = document.createAttribute("onclick");
                att1.value = "myFunc()";
                //b.id = 'name1';
                  b.setAttributeNode(att1);

                  var t = document.createTextNode("clik it");
                b.appendChild(t);

            // The variable iDiv is still good... Just append to it.
                document.getElementById("firstdiv").appendChild(innerDiv);
        }
        document.getElementById("name1").onclick = function() {
            alert("hiihihihiih");
        };

        //document.getElementById("demo").innerHTML = x;
        function myFunc(){
            alert("hiihihihiih");
        }


    </script>
</head>
<body>
<form action="new.php" method="post">
    <input type="date" name="dat" id="dat">
    <button type="submit">sub</button>
</form>
<?php  

    if(!empty($_POST['goch'])){
        echo "my gogo if ".$_POST['goch'];
    }

    if(!empty($_POST['dat'])){
        $dat = $_POST['dat'];
        echo "intial".$dat;

        $p = substr($dat,5,2);
        $q = substr($dat,8,2);
        echo '<br>';
        echo "moth".$p;
        echo '<br>';
        echo "day".$q;
        $pq = $q."-".$p;
        echo '<br>';
        echo "dd-mm".$pq;

    }
?>

<div id="firstdiv" style="width:1000px ;height:500px;border-width:1px ;border-style:solid; margin:5px">
    
</div>
<p id="demo"></p>
<script type="text/javascript">
    
</script>

<?php
    $piy = "<script> document.write(ja)</script>";
    echo "power".$piy."go";
?>



<?php
/*
    if(!empty($_POST['name']) && !empty($_POST['class']))
    {
        echo $_POST['name']."<br>";
        echo $_POST['class'];
    }
    */
?>
<!--
<form id="setform" action="new.php" method="post">
<input type="hidden" name="name" value="piyush">
<input type="hidden" name="class" value="1st">
<button type="submit">submit</button>
</form>
-->

<button onclick="makeDiv()">make div</button>




</body>
</html>
