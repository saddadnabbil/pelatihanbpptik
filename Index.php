<?php
$tersubmit = false; // mengecek apakah user sudah mengklik submit

$error = false; // membantu untuk menangkap eror

$errBilanganPertama = ""; // untuk mengirim pesan eror dari input bilangan pertama
$errBilanganKedua = ""; // untuk mengirim pesan eror dari input bilangan kedua


function calculate($bilanganPertama, $bilanganKedua)
{
    $pertambahan = [
        'label' => 'Pertambahan',
        'text' => $bilanganPertama . " + " . $bilanganKedua,
        'result' => ($bilanganPertama + $bilanganKedua)
    ];

    $pengurangan = [
        'label' => 'Pengurangan',
        'text' => $bilanganPertama . " - " . $bilanganKedua,
        'result' => ($bilanganPertama - $bilanganKedua)
    ];

    $perkalian = [
        'label' => 'Perkalian',
        'text' => $bilanganPertama . " * " . $bilanganKedua,
        'result' => ($bilanganPertama * $bilanganKedua)
    ];

    $pembagian = [
        'label' => 'Pembagian',
        'text' => $bilanganPertama . " / " . $bilanganKedua,
        'result' => ($bilanganPertama / $bilanganKedua)
    ];


    //Menetapkan setiap operator array dan me-return
    return [
        $pertambahan,
        $pengurangan,
        $perkalian,
        $pembagian, 
    ];
}


if (isset($_POST['calc'])) {
    //Store each input value to variable
    $bilanganPertama = $_POST['first_number'];
    $bilanganKedua = $_POST['second_number'];

    /*
     * Bilangan Pertama blok validasi
     * */
    //ketika user menginput bilangan negatif di input Bilangan Pertama
    if($bilanganPertama <= 0) {
        $error = true;
        $errBilanganPertama = "Mohon, Masukan Bilangan Positif!";
    }

    //ketika user mengosongkan input Bilangan Pertama
    if(empty(trim($bilanganPertama))) {
        $error = true;
        $errBilanganPertama = "Mohon, Masukan Angka!";
    }

    /*
     * Bilangan Kedua validation*/
    //ketika user menginput bilangan negatif di input Bilangan Kedua
    if($bilanganKedua <= 0) {
        $error = true;
        $errBilanganKedua = "Mohon, Masukan Bilangan Positif!";
    }
    //ketika user mengosongkan input Bilangan Kedua
    if(empty(trim($bilanganKedua))) {
        $error = true;
        $errBilanganKedua = "Mohon, Masukan Angka!";
    }

    //Ketika eror tidak true (false), itu berarti tidak eror
    if($error !== true) {

        $calculationResults = calculate($bilanganPertama, $bilanganKedua);

        //membentuk variabel isSubmitted menjadi true
        $isSumbitted = true;
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kalkulator Sederhana!</title>
    <link rel="stylesheet" href="css/bulma.min.css">
</head>
<body>
<section class="section">
    <div class="container">
        <h1 class="title">
            Kalkulator Sederhana
        </h1>

        <hr>
        <form action="" class=" column is-three-fifths" method="POST">
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Bilangan Pertama</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <input class="input" min="1" name="first_number" type="number" placeholder="Masukan Angka" required>
                            <span class="has-text-danger"><?php echo $errBilanganPertama; ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Bilangan Kedua</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <input class="input" min="1" name="second_number" type="number" placeholder="Masukan Angka" required>
                            <span class="has-text-danger"><?php echo $errBilanganKedua; ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="field is-horizontal">
                <div class="field-label">
                    <!-- Membiarkan kosong untuk spasi -->
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <button class="button is-primary" type="submit" name="calc">
                                Hitung!
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <?php
        //ketika isSubmitted true, berarti user user sudah mensubmit dan tidak eror
            if($isSumbitted):
        ?>
            <hr>
            <h4>Hasil:</h4>
            <table class="table is-bordered is-striped">
                <?php foreach ($calculationResults as $result):?>
                    <tr>
                        <td><?php echo $result['label']; ?></td>
                        <td><?php echo $result['text']; ?></td>
                        <td><?php echo $result['result']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
</section>
</body>
</html>