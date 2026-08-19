<?php

namespace Database\Seeders;

use App\Models\Material;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus materi contoh sebelumnya
        Material::query()->delete();

        /*
        |--------------------------------------------------------------------------
        | 1. PENGERTIAN
        |--------------------------------------------------------------------------
        */

        Material::create([
            'pertemuan' => 0,
            'judul' => 'Pengertian Lagu dan Musik Tradisional',
            'kategori' => 'Pengertian',
            'isi' => <<<'HTML'
<h2>Pengertian Lagu dan Musik Tradisional</h2>

<p><strong>Lagu Tradisional/daerah</strong> adalah lagu yang tumbuh, berkembang, dan diwariskan secara turun-temurun dalam kehidupan masyarakat di suatu daerah serta mencerminkan budaya, bahasa, adat istiadat, dan karakter masyarakat daerah tersebut.</p>

<p>Lagu daerah merupakan bagian dari kekayaan budaya Indonesia. Lagu daerah biasanya menggunakan bahasa daerah dan memiliki melodi, irama, atau gaya penyajian yang berkaitan dengan kebudayaan setempat.</p>

<p>Banyak lagu daerah diwariskan secara lisan, sehingga pencipta aslinya tidak diketahui atau tidak tercatat dengan jelas. Namun, ada pula lagu daerah yang penciptanya diketahui.</p>

<p><strong>Musik tradisional</strong> adalah musik yang berkembang dalam kehidupan masyarakat suatu daerah, diwariskan dari generasi ke generasi, dan menjadi bagian dari kebudayaan masyarakat tersebut.</p>

<p>Musik tradisional tidak hanya berupa lagu atau vokal, tetapi juga dapat berupa permainan alat musik, pola ritme, melodi, harmoni, bentuk penyajian, dan aturan musikal yang berkembang dalam suatu tradisi.</p>

<p>Musik tradisional biasanya memiliki hubungan erat dengan adat istiadat, upacara, kepercayaan, kehidupan sosial, hiburan, dan identitas masyarakat.</p>

<h2>Ciri-Ciri Musik Tradisional</h2>

<ol>
    <li>Dipelajari dan diwariskan secara lisan dari generasi ke generasi.</li>
    <li>Tidak memiliki notasi tertulis (umumnya).</li>
    <li>Bersifat informal dan menyatu dengan kehidupan masyarakat.</li>
    <li>Menggunakan alat musik dan bahasa daerah setempat.</li>
</ol>
HTML,
            'aktif' => true,
        ]);

        /*
        |--------------------------------------------------------------------------
        | 2. CIRI-CIRI
        |--------------------------------------------------------------------------
        */

        Material::create([
            'pertemuan' => 0,
            'judul' => 'Ciri-Ciri Musik Tradisional',
            'kategori' => 'Ciri-Ciri',
            'isi' => <<<'HTML'
<h2>Ciri-Ciri Musik Tradisional</h2>

<ol>
    <li>Dipelajari dan diwariskan secara lisan dari generasi ke generasi.</li>
    <li>Tidak memiliki notasi tertulis (umumnya).</li>
    <li>Bersifat informal dan menyatu dengan kehidupan masyarakat.</li>
    <li>Menggunakan alat musik dan bahasa daerah setempat.</li>
</ol>
HTML,
            'aktif' => true,
        ]);

        /*
        |--------------------------------------------------------------------------
        | 3. FUNGSI
        |--------------------------------------------------------------------------
        */

        Material::create([
            'pertemuan' => 0,
            'judul' => 'Fungsi Musik Tradisional',
            'kategori' => 'Fungsi',
            'isi' => <<<'HTML'
<h2>Fungsi Musik Tradisional</h2>

<h3>1. Fungsi Ritual/Upacara Adat</h3>

<p>Musik digunakan sebagai bagian dari pelaksanaan upacara atau ritual tertentu yang berkaitan dengan tradisi masyarakat.</p>

<p><strong>Contoh:</strong></p>
<ul>
    <li>Musik gamelan dalam upacara adat Jawa dan Bali.</li>
    <li>Musik tradisional dalam upacara adat masyarakat Dayak.</li>
    <li>Musik tradisional dalam berbagai ritual masyarakat Papua.</li>
</ul>

<p><strong>Fungsinya:</strong> menciptakan suasana khidmat, sakral, dan mendukung jalannya upacara.</p>

<h3>2. Fungsi Keagamaan/Religi</h3>

<p>Musik digunakan untuk mendukung kegiatan yang berkaitan dengan kehidupan keagamaan atau spiritual masyarakat.</p>

<p><strong>Contoh:</strong></p>
<ul>
    <li>Musik rebana dalam kegiatan keagamaan masyarakat.</li>
    <li>Tembang atau nyanyian tradisional yang mengandung nilai-nilai keagamaan.</li>
</ul>

<p><strong>Fungsinya:</strong> membantu menyampaikan pesan spiritual, menciptakan suasana religius, dan menjadi bagian dari kegiatan keagamaan.</p>

<h3>3. Fungsi Hiburan</h3>

<p>Musik digunakan untuk memberikan kesenangan dan hiburan kepada masyarakat.</p>

<p><strong>Contoh:</strong></p>
<ul>
    <li>Pertunjukan musik tradisional dalam acara masyarakat.</li>
    <li>Pertunjukan angklung untuk wisatawan.</li>
    <li>Pertunjukan musik tradisional dalam festival budaya.</li>
</ul>

<p><strong>Fungsinya:</strong> menghibur, mengurangi kejenuhan, dan memberikan pengalaman menyenangkan.</p>

<h3>4. Fungsi Pertunjukan</h3>

<p>Musik digunakan sebagai bagian dari sebuah pertunjukan seni.</p>

<p><strong>Contoh:</strong></p>
<ul>
    <li>Gamelan dalam pertunjukan wayang.</li>
    <li>Musik tradisional dalam pertunjukan teater daerah.</li>
    <li>Musik tradisional dalam festival budaya.</li>
</ul>

<p><strong>Fungsinya:</strong> mendukung jalannya pertunjukan dan membangun suasana bagi penonton.</p>

<h3>5. Fungsi Pengiring Tari</h3>

<p>Musik berfungsi sebagai pengiring gerakan tari.</p>

<p><strong>Contoh:</strong></p>
<ul>
    <li>Gamelan mengiringi tari tradisional Jawa dan Bali.</li>
    <li>Musik tradisional Sunda mengiringi tari Jaipongan.</li>
    <li>Tifa digunakan untuk mengiringi berbagai tarian di Papua.</li>
</ul>

<p><strong>Fungsinya:</strong> memberikan irama, tempo, dinamika, dan suasana yang mendukung gerakan penari.</p>

<h3>6. Fungsi Pengiring Teater dan Drama</h3>

<p>Musik tradisional dapat digunakan untuk mendukung pertunjukan drama atau teater tradisional.</p>

<p><strong>Contoh:</strong></p>
<ul>
    <li>Gamelan dalam pertunjukan wayang kulit.</li>
    <li>Musik dalam pertunjukan ketoprak.</li>
    <li>Musik dalam pertunjukan tradisional daerah lainnya.</li>
</ul>

<p><strong>Fungsinya:</strong> membangun suasana, memperkuat karakter adegan, dan memberikan tanda pergantian bagian pertunjukan.</p>

<h3>7. Fungsi Komunikasi</h3>

<p>Pada beberapa masyarakat, musik digunakan sebagai sarana menyampaikan pesan atau tanda tertentu.</p>

<p><strong>Contoh:</strong></p>
<ul>
    <li>Bunyi kentongan sebagai tanda atau pemberitahuan kepada masyarakat.</li>
    <li>Bunyi alat musik tertentu sebagai tanda dimulainya kegiatan adat.</li>
    <li>Musik atau bunyi tradisional sebagai sarana memanggil atau mengumpulkan masyarakat.</li>
</ul>

<p><strong>Fungsinya:</strong> menyampaikan informasi atau tanda kepada anggota masyarakat.</p>
HTML,
            'aktif' => true,
        ]);

        /*
        |--------------------------------------------------------------------------
        | 4. LAGU DAERAH
        |--------------------------------------------------------------------------
        */

        Material::create([
            'pertemuan' => 0,
            'judul' => 'Tabel Lagu Daerah Nusantara',
            'kategori' => 'Lagu Daerah',
            'isi' => <<<'HTML'
<h2>Tabel Lagu Daerah Nusantara</h2>

<table border="1" cellpadding="8" cellspacing="0" style="width:100%; border-collapse:collapse;">
    <thead>
        <tr>
            <th>No</th>
            <th>Lagu Daerah</th>
            <th>Asal Daerah</th>
        </tr>
    </thead>
    <tbody>
        <tr><td>1</td><td>Apuse</td><td>Papua</td></tr>
        <tr><td>2</td><td>Ampar-Ampar Pisang</td><td>Kalimantan Selatan</td></tr>
        <tr><td>3</td><td>Bubuy Bulan</td><td>Jawa Barat</td></tr>
        <tr><td>4</td><td>Gundul-Gundul Pacul</td><td>Jawa Tengah</td></tr>
        <tr><td>5</td><td>Sinanggar Tulo</td><td>Sumatera Utara</td></tr>
        <tr><td>6</td><td>Suwe Ora Jamu</td><td>Jawa Tengah</td></tr>
        <tr><td>7</td><td>Yamko Rambe Yamko</td><td>Papua</td></tr>
        <tr><td>8</td><td>Manuk Dadali</td><td>Jawa Barat</td></tr>
        <tr><td>9</td><td>Bungong Jeumpa</td><td>Aceh</td></tr>
        <tr><td>10</td><td>Butet</td><td>Sumatera Utara</td></tr>
        <tr><td>11</td><td>Cik Cik Periuk</td><td>Kalimantan Barat</td></tr>
        <tr><td>12</td><td>Jali-Jali</td><td>DKI Jakarta</td></tr>
        <tr><td>13</td><td>Kicir-Kicir</td><td>DKI Jakarta</td></tr>
        <tr><td>14</td><td>Lir Ilir</td><td>Jawa Tengah</td></tr>
        <tr><td>15</td><td>O Ina Ni Keke</td><td>Sulawesi Utara</td></tr>
        <tr><td>16</td><td>Pakarena</td><td>Sulawesi Selatan</td></tr>
        <tr><td>17</td><td>Rasa Sayange</td><td>Maluku</td></tr>
        <tr><td>18</td><td>Soleram</td><td>Riau</td></tr>
        <tr><td>19</td><td>Tokecang</td><td>Jawa Barat</td></tr>
        <tr><td>20</td><td>Tanduk Majeng</td><td>Jawa Timur</td></tr>
    </tbody>
</table>
HTML,
            'aktif' => true,
        ]);

        /*
        |--------------------------------------------------------------------------
        | 5. MUSIK TRADISIONAL
        |--------------------------------------------------------------------------
        */

        Material::create([
            'pertemuan' => 0,
            'judul' => 'Tabel Alat Musik Tradisional Nusantara',
            'kategori' => 'Musik Tradisional',
            'isi' => <<<'HTML'
<h2>Tabel Alat Musik Tradisional Nusantara</h2>

<table border="1" cellpadding="8" cellspacing="0" style="width:100%; border-collapse:collapse;">
    <thead>
        <tr>
            <th>No</th>
            <th>Alat Musik</th>
            <th>Asal Daerah</th>
        </tr>
    </thead>
    <tbody>
        <tr><td>1</td><td>Gamelan</td><td>Jawa &amp; Bali</td></tr>
        <tr><td>2</td><td>Angklung</td><td>Jawa Barat</td></tr>
        <tr><td>3</td><td>Sasando</td><td>Nusa Tenggara Timur</td></tr>
        <tr><td>4</td><td>Kolintang</td><td>Sulawesi Utara</td></tr>
        <tr><td>5</td><td>Tifa</td><td>Papua &amp; Maluku</td></tr>
        <tr><td>6</td><td>Saluang</td><td>Sumatera Barat</td></tr>
        <tr><td>7</td><td>Kecapi</td><td>Jawa Barat</td></tr>
        <tr><td>8</td><td>Gong</td><td>Jawa &amp; Bali</td></tr>
        <tr><td>9</td><td>Kendang</td><td>Jawa Barat</td></tr>
        <tr><td>10</td><td>Bonang</td><td>Jawa Tengah</td></tr>
        <tr><td>11</td><td>Rebab</td><td>Jawa</td></tr>
        <tr><td>12</td><td>Serunai</td><td>Sumatera Barat</td></tr>
        <tr><td>13</td><td>Talempong</td><td>Sumatera Barat</td></tr>
        <tr><td>14</td><td>Aramba</td><td>Sumatera Utara</td></tr>
        <tr><td>15</td><td>Fu</td><td>Maluku Utara</td></tr>
        <tr><td>16</td><td>Panting</td><td>Kalimantan Selatan</td></tr>
        <tr><td>17</td><td>Sampe</td><td>Kalimantan Timur</td></tr>
        <tr><td>18</td><td>Gambus</td><td>Riau</td></tr>
        <tr><td>19</td><td>Ceng-Ceng</td><td>Bali</td></tr>
        <tr><td>20</td><td>Pikon</td><td>Papua</td></tr>
    </tbody>
</table>
HTML,
            'aktif' => true,
        ]);

        /*
        |--------------------------------------------------------------------------
        | 6. UNSUR MUSIK
        |--------------------------------------------------------------------------
        */

        Material::create([
            'pertemuan' => 0,
            'judul' => 'Unsur-Unsur Musik',
            'kategori' => 'Unsur Musik',
            'isi' => <<<'HTML'
<h2>Unsur-Unsur Musik</h2>

<h3>1. Bunyi</h3>

<p>Bunyi merupakan unsur paling dasar dalam musik. Musik terbentuk dari bunyi yang disusun secara teratur sehingga menghasilkan karya musik.</p>

<p>Dalam musik, bunyi memiliki beberapa sifat utama:</p>

<ul>
    <li>Tinggi rendah bunyi (pitch) → menentukan tinggi atau rendahnya nada.</li>
    <li>Panjang pendek bunyi (durasi) → menentukan lama suatu bunyi berlangsung.</li>
    <li>Kuat lemah bunyi (intensitas) → berkaitan dengan keras atau lembutnya bunyi.</li>
    <li>Warna bunyi (timbre) → membedakan karakter suara satu sumber bunyi dengan sumber lainnya.</li>
</ul>

<p><strong>Contoh:</strong> Nada yang dimainkan pada piano dan nada yang sama dimainkan pada biola dapat memiliki tinggi nada yang sama, tetapi warna bunyinya berbeda.</p>

<h3>2. Nada</h3>

<p>Nada adalah bunyi yang memiliki tinggi rendah tertentu dan dapat disusun secara musikal. Nada menjadi bahan dasar untuk membentuk melodi, akor, dan harmoni.</p>

<p>Nada biasanya dituliskan menggunakan not angka: 1 2 3 4 5 6 7 dan not balok. Dalam solmisasi: Do – Re – Mi – Fa – Sol – La – Si – Do.</p>

<p>Tinggi rendah nada dapat bergerak naik, turun, atau tetap. Contoh: Do – Re – Mi – Fa – Sol (naik); Sol – Fa – Mi – Re – Do (turun).</p>

<h3>3. Melodi</h3>

<p>Melodi adalah rangkaian nada yang disusun secara berurutan sehingga membentuk kesatuan musikal yang dapat dikenali. Melodi biasanya menjadi bagian yang paling mudah dikenali dalam sebuah lagu. Contoh: Do – Re – Mi – Sol – Mi – Re – Do.</p>

<p>Melodi memiliki unsur tinggi rendah nada, arah gerak nada, interval, panjang pendek nada, dan pola frase. Jenis gerak melodi: gerak melangkah (Do – Re – Mi – Fa), gerak melompat (Do – Mi – Sol), dan gerak berulang (Do – Do – Re – Re – Mi).</p>

<h3>4. Ritme/Irama</h3>

<p>Ritme atau irama adalah susunan panjang-pendek bunyi dan diam yang membentuk pola dalam musik. Ritme membuat musik memiliki gerakan dan keteraturan waktu.</p>

<p>Contoh: TA – TA – TI-TI – TA.</p>

<p>Ritme berkaitan dengan panjang pendek nada, ketukan, aksen, pola bunyi, dan tanda diam. Tepuk – Tepuk – Diam – Tepuk sudah dapat membentuk pola ritmis.</p>

<p>Ritme berkaitan dengan pola waktu, sedangkan melodi berkaitan dengan rangkaian tinggi-rendah nada.</p>

<h3>5. Ketukan/Beat</h3>

<p>Ketukan (beat) adalah denyut dasar yang teratur dalam musik, seperti 1 – 2 – 3 – 4. Ketukan menjadi dasar pemain musik untuk menjaga keteraturan waktu.</p>

<h3>6. Birama</h3>

<p>Birama adalah pengelompokan ketukan secara teratur. Birama 2/4 memiliki 2 ketukan; birama 3/4 memiliki 3 ketukan dan sering diasosiasikan dengan waltz; birama 4/4 memiliki 4 ketukan dan sangat umum; birama 6/8 memiliki enam hitungan not seperdelapan dalam dua kelompok tiga ketukan.</p>

<h3>7. Tempo</h3>

<p>Tempo adalah cepat atau lambatnya lagu dimainkan atau dinyanyikan.</p>

<p>Istilah umum: Largo sangat lambat, Lento lambat, Adagio lambat dan tenang, Andante sedang seperti langkah berjalan, Moderato sedang, Allegretto agak cepat, Allegro cepat, Vivace cepat dan hidup, Presto sangat cepat.</p>

<p>Tempo juga dinyatakan dengan BPM, misalnya ♩ = 80 BPM.</p>

<h3>8. Dinamika</h3>

<p>Dinamika adalah perubahan atau tingkat keras dan lembutnya bunyi.</p>

<p>Tanda dinamika: pp pianissimo sangat lembut, p piano lembut, mp mezzo piano agak lembut, mf mezzo forte agak kuat, f forte kuat, ff fortissimo sangat kuat.</p>

<p>Crescendo (&lt;) berarti semakin kuat, sedangkan decrescendo/diminuendo (&gt;) semakin lembut.</p>

<p>Contoh: p → mp → mf → f.</p>

<h3>9. Harmoni</h3>

<p>Harmoni adalah keselarasan atau perpaduan beberapa nada yang dibunyikan bersama atau disusun selaras.</p>

<p>Harmoni berkaitan dengan akor dan progresi akor. Do – Mi – Sol menghasilkan akor C mayor.</p>

<p>Harmoni memperkuat melodi, menciptakan suasana, memberi warna lagu, dan menjadi dasar iringan.</p>

<p>Contoh progresi: C – F – G – C.</p>

<h3>10. Akor</h3>

<p>Akor adalah gabungan beberapa nada yang dibunyikan bersamaan dan memiliki hubungan harmonis.</p>

<p>Akor C mayor: C – E – G; F mayor: F – A – C; G mayor: G – B – D.</p>

<p>Akor banyak digunakan sebagai iringan lagu.</p>

<h3>11. Tangga Nada</h3>

<p>Tangga nada adalah susunan nada berdasarkan pola interval tertentu.</p>

<p>Tangga nada mayor berpola 1 – 1 – ½ – 1 – 1 – 1 – ½, contohnya C – D – E – F – G – A – B – C, dengan karakter cerah, kuat, dan gembira.</p>

<p>Tangga nada minor sering diasosiasikan dengan karakter lembut, sedih, melankolis, atau khidmat.</p>

<p>Contoh A minor natural: A – B – C – D – E – F – G – A.</p>

<h3>12. Interval</h3>

<p>Interval adalah jarak antara satu nada dengan nada lainnya: C–D sekon, C–E terts, C–F kwart, C–G kwint, C–A sekst, C–B septim, dan C–C’ oktaf.</p>

<p>Interval penting untuk memahami melodi, akor, tangga nada, dan harmoni.</p>

<h3>13. Timbre / Warna Bunyi</h3>

<p>Timbre adalah karakter atau warna khas bunyi yang membedakan sumber bunyi.</p>

<p>Nada C pada piano, gitar, biola, dan suling dapat memiliki tinggi sama tetapi warna berbeda.</p>

<p>Dalam musik tradisional: angklung memiliki warna bambu khas, kendang warna perkusi kuat, sasando warna senar lembut dan resonan, serta suling Sunda warna tiup lembut dan mendayu.</p>

<h3>14. Artikulasi</h3>

<p>Artikulasi adalah cara mengucapkan atau memainkan nada agar terdengar jelas sesuai karakter yang diinginkan.</p>

<p>Dalam bernyanyi, artikulasi berkaitan dengan kejelasan lirik, misalnya kata Indonesia harus dinyanyikan dengan jelas.</p>

<p>Dalam instrumen, artikulasi dapat berupa terputus, bersambung, ditekan, atau diberi penekanan tertentu.</p>

<h3>15. Frasering</h3>

<p>Frasering adalah cara pemenggalan kalimat musik atau lagu agar terdengar teratur dan bermakna.</p>

<p>Frasering berkaitan dengan pengaturan napas.</p>

<p>Contoh: Aku cinta Indonesia / Tanah airku tercinta //.</p>

<p>Tanda / menunjukkan tempat pemenggalan frase.</p>

<p>Frasering membantu mengambil napas tepat, menyampaikan makna lirik, dan menjaga kesinambungan kalimat musik.</p>

<h3>16. Ekspresi</h3>

<p>Ekspresi adalah cara penyanyi atau pemain musik menyampaikan perasaan, karakter, dan makna musik melalui penampilannya.</p>

<p>Ekspresi ditunjukkan melalui dinamika, tempo, artikulasi, frasering, warna suara, gestur, dan penghayatan.</p>

<p>Lagu sedih tidak hanya dinyanyikan dengan nada benar, tetapi juga dengan penghayatan yang sesuai.</p>
HTML,
            'aktif' => true,
        ]);

        /*
        |--------------------------------------------------------------------------
        | 7. TEKNIK VOKAL 1
        |--------------------------------------------------------------------------
        */

        Material::create([
            'pertemuan' => 0,
            'judul' => 'Teknik Vokal 1',
            'kategori' => 'Teknik Vokal 1',
            'isi' => <<<'HTML'
<h2>Teknik Vokal &amp; Jenis Pernafasan</h2>

<h3>A. Pengertian Teknik Vokal</h3>

<p>Teknik vokal adalah cara atau keterampilan menggunakan suara dengan benar dan terkontrol dalam bernyanyi sehingga menghasilkan suara yang jelas, tepat nada, stabil, nyaman, dan ekspresif.</p>

<p>Teknik vokal meliputi sikap tubuh, pernapasan, artikulasi, intonasi, resonansi, frasering, pembentukan suara, legato, staccato, dinamika, tempo, vibrato, ekspresi, dan penghayatan.</p>

<h3>B. Sikap Tubuh / Postur</h3>

<p>Postur yang benar membantu pernapasan, produksi suara, dan penampilan.</p>

<p>Saat berdiri:</p>

<ul>
    <li>Kepala tegak.</li>
    <li>Pandangan ke depan.</li>
    <li>Leher dan bahu rileks.</li>
    <li>Dada alami.</li>
    <li>Punggung tegak.</li>
    <li>Perut tidak ditegangkan.</li>
    <li>Kaki selebar bahu.</li>
    <li>Lutut tidak dikunci.</li>
</ul>

<p><strong>Latihan:</strong> berdiri tegak, rilekskan bahu dan rahang, jangan mengangkat dagu, tarik napas alami, lalu pertahankan posisi saat bernyanyi.</p>

<h3>C. Pernapasan</h3>

<p>Pernapasan adalah proses masuk dan keluarnya udara yang menjadi sumber tenaga suara.</p>

<p>Fungsinya mempertahankan nada, menyanyikan frase panjang, mengatur volume dan dinamika, serta mendukung ekspresi.</p>

<p>Secara fisiologis udara tetap masuk ke paru-paru; istilah dada, perut, dan diafragma menjelaskan bagian tubuh yang paling terasa bergerak.</p>

<h4>1. Pernapasan dada</h4>

<p>Dada dan tulang rusuk bagian atas mengembang saat menarik napas. Bahu dapat ikut terangkat dan perut relatif sedikit bergerak.</p>

<p>Untuk frase panjang, jangan hanya mengandalkan pola ini karena kontrol udara lebih terbatas.</p>

<p><strong>Latihan:</strong> satu tangan di dada, tarik 4 hitungan, keluarkan perlahan 8 hitungan.</p>

<h4>2. Pernapasan perut</h4>

<p>Gerakan lebih terasa pada perut karena diafragma turun; udara tetap masuk ke paru-paru, bukan ke perut.</p>

<p><strong>Latihan:</strong> sambil berbaring, satu tangan di dada dan satu di perut, tarik napas 4 hitungan lalu keluarkan dengan bunyi Sssss secara stabil.</p>

<h4>3. Pernapasan diafragma</h4>

<p>Diafragma berkontraksi dan bergerak ke bawah sehingga rongga dada membesar.</p>

<p>Rasakan perut mengembang dan sisi tulang rusuk melebar, sementara bahu serta leher tetap rileks.</p>

<p><strong>Latihan:</strong> tarik 4, keluarkan 8; kemudian 4–10 dan 4–12 tanpa memaksakan diri.</p>

<p>Pernapasan ini membantu kontrol udara, kestabilan suara, frase panjang, dinamika, dan produksi suara rileks.</p>

<h3>D. Artikulasi dan Intonasi</h3>

<p>Artikulasi adalah kejelasan pengucapan bunyi, suku kata, kata, dan lirik.</p>

<p><strong>Latihan:</strong> A–I–U–E–O, Pa–Pi–Pu–Pe–Po, Ta–Ti–Tu–Te–To, Ka–Ki–Ku–Ke–Ko.</p>

<p>Tujuannya agar lirik dan bahasa lagu, termasuk bahasa daerah, mudah dipahami.</p>

<p>Intonasi adalah ketepatan tinggi rendah nada.</p>

<p><strong>Latihan:</strong> Do–Re–Mi–Fa–Sol–Fa–Mi–Re–Do dengan piano atau keyboard: dengarkan, tirukan, bandingkan, koreksi, dan ulangi.</p>

<h3>E. Resonansi dan Frasering</h3>

<p>Resonansi adalah penguatan dan pewarnaan suara melalui rongga mulut, hidung, dada, dan ruang sekitar kepala.</p>

<p><strong>Latihan:</strong> Mmmm lalu Ma–Me–Mi–Mo–Mu; rasakan getaran ringan di wajah dan jangan berteriak.</p>

<p>Frasering adalah pemenggalan kalimat musik sesuai makna lirik dan kebutuhan napas.</p>

<p>Jangan mengambil napas di tengah kata.</p>

<p><strong>Contoh:</strong> Indonesia tanah airku / Tanah tumpah darahku //.</p>

<h3>F. Pembentukan Suara</h3>

<p>Suara dibentuk melalui koordinasi pernapasan, pita suara, resonansi, dan alat artikulasi tanpa memaksa tenggorokan.</p>

<p>Mulai dengan Mmmm lalu Ma–Me–Mi–Mo–Mu pada nada nyaman agar suara stabil dan mudah dikontrol.</p>
HTML,
            'aktif' => true,
        ]);

        /*
        |--------------------------------------------------------------------------
        | 8. TEKNIK VOKAL 2
        |--------------------------------------------------------------------------
        */

        Material::create([
            'pertemuan' => 0,
            'judul' => 'Teknik Vokal 2',
            'kategori' => 'Teknik Vokal 2',
            'isi' => <<<'HTML'
<h2>Lanjutan Teknik Vokal</h2>

<h3>G. Legato dan Staccato</h3>

<p>Legato adalah menyanyikan beberapa nada secara tersambung, halus, dan mengalir: Do–Re–Mi–Fa–Sol atau Ma-ma-ma-ma-ma.</p>

<p>Staccato adalah menyanyikan nada pendek dan terpisah: Do–Do–Do atau Ha–Ha–Ha untuk melatih kontrol suara, ketepatan nada, artikulasi, dan kelincahan vokal.</p>

<h3>H. Dinamika dan Tempo</h3>

<p>Dinamika mengatur keras-lembut suara: pp sangat lembut, p lembut, mp agak lembut, mf agak kuat, f kuat, ff sangat kuat.</p>

<p>Crescendo berarti semakin kuat dan decrescendo semakin lembut.</p>

<p>Tempo mengatur cepat-lambat lagu: Largo sangat lambat, Lento lambat, Adagio lambat dan tenang, Andante sedang, Moderato sedang, Allegretto agak cepat, Allegro cepat, Vivace cepat dan hidup, Presto sangat cepat.</p>

<h3>I. Vibrato</h3>

<p>Vibrato adalah variasi kecil dan teratur pada tinggi nada untuk memberi warna suara.</p>

<p>Latih setelah napas dan suara terkendali dengan menahan nada Aaaaa secara nyaman; pemula tidak perlu memaksakan vibrato.</p>

<h3>J. Ekspresi dan Penghayatan</h3>

<p>Ekspresi menyampaikan perasaan, karakter, dan suasana lagu melalui dinamika, tempo, artikulasi, frasering, warna suara, wajah, dan penghayatan.</p>

<p>Penghayatan dilakukan dengan membaca lirik, memahami arti dan latar belakang lagu, menentukan suasana serta bagian yang perlu ditekankan.</p>

<p>Lagu daerah juga perlu dipahami budaya dan konteks asalnya.</p>

<h3>K. Pembentukan Vokal A–I–U–E–O</h3>

<p>Vokal harus diucapkan jelas.</p>

<p><strong>Latihan:</strong> A–A–A–A–A, I–I–I–I–I, U–U–U–U–U, E–E–E–E–E, O–O–O–O–O, kemudian Ma–Me–Mi–Mo–Mu.</p>

<p>Latihan ini melatih artikulasi, kelenturan mulut, kejelasan vokal, dan pembentukan suara.</p>

<h3>L. Teknik Pengambilan Napas dalam Lagu</h3>

<p>Sesuaikan napas dengan frasering: tarik napas, nyanyikan frase, ambil napas, lalu lanjutkan frase.</p>

<p>Hindari mengambil napas di tengah kata, di tengah kalimat yang maknanya belum selesai, atau secara terburu-buru.</p>

<p><strong>Contoh:</strong> Aku cinta Indonesia / tanah air tercinta //.</p>
HTML,
            'aktif' => true,
        ]);

        /*
        |--------------------------------------------------------------------------
        | 9. TEKNIK VOKAL 3
        |--------------------------------------------------------------------------
        |
        | Gambar tabel Tempo & Dinamika akan kita masukkan setelah
        | fitur upload gambar selesai.
        |
        */

        Material::create([
            'pertemuan' => 0,
            'judul' => 'Teknik Vokal 3',
            'kategori' => 'Teknik Vokal 3',
            'isi' => <<<'HTML'
<h2>Teknik Vokal 3</h2>

<p>Materi Teknik Vokal 3 berisi gambar tabel <strong>Dinamika &amp; Tempo</strong> dari materi pembelajaran.</p>

<p><em>Gambar akan ditambahkan melalui fitur upload gambar pada editor materi.</em></p>
HTML,
            'aktif' => true,
        ]);
    }
}