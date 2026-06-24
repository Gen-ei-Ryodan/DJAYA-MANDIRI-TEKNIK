<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\Testimonial;
use App\Models\Message;
use Illuminate\Database\Seeder;

class DummyDataSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedProductCategories();
        $this->seedProducts();
        $this->seedProjectCategories();
        $this->seedProjects();
        $this->seedArticleCategories();
        $this->seedArticles();
        $this->seedTestimonials();
        $this->seedMessages();
    }

    private function seedProductCategories(): void
    {
        $categories = [
            ['name' => 'Air Terminal / Penangkap Petir', 'slug' => 'air-terminal', 'description' => 'Air terminal atau penangkap petir berbagai jenis untuk kebutuhan proteksi eksternal.', 'order' => 1],
            ['name' => 'Kabel Konduktor', 'slug' => 'kabel-konduktor', 'description' => 'Kabel konduktor berkualitas tinggi untuk sistem penyalur arus petir.', 'order' => 2],
            ['name' => 'Grounding System', 'slug' => 'grounding-system', 'description' => 'Sistem pembumian lengkap dengan elektroda dan aksesoris pendukung.', 'order' => 3],
            ['name' => 'Surge Protection Device (SPD)', 'slug' => 'spd', 'description' => 'Alat pelindung lonjakan arus untuk proteksi peralatan elektronik.', 'order' => 4],
            ['name' => 'Aksesoris Instalasi', 'slug' => 'aksesoris-instalasi', 'description' => 'Berbagai aksesoris pendukung instalasi sistem penangkal petir.', 'order' => 5],
            ['name' => 'Equipment & Tools', 'slug' => 'equipment-tools', 'description' => 'Peralatan dan alat ukur untuk instalasi dan maintenance sistem proteksi petir.', 'order' => 6],
        ];

        foreach ($categories as $cat) {
            ProductCategory::create($cat);
        }
    }

    private function seedProducts(): void
    {
        $catIds = ProductCategory::pluck('id', 'slug');

        $products = [
            // Air Terminal
            ['category_slug' => 'air-terminal', 'name' => 'Air Terminal Early Streamer Emission (ESE) Premium', 'slug' => 'air-terminal-ese-premium', 'description' => 'Air terminal tipe Early Streamer Emission (ESE) generasi terbaru dengan jangkauan proteksi hingga 150 meter. Dilengkapi teknologi ionisasi dini yang mampu memicu pelepasan muatan lebih awal dibanding terminal konvensional. Cocok untuk gedung tinggi, pabrik, dan area industri luas.', 'specification' => "Tipe: ESE\nJangkauan Proteksi: ~150 meter (sesuai NF C 17-102)\nMaterial: Stainless Steel 316L\nTinggi Terminal: 2 meter\nBerat: 8.5 kg\nSertifikasi: INERIS, SNI IEC 62305\nGaransi: 5 tahun", 'featured' => true, 'order' => 1],
            ['category_slug' => 'air-terminal', 'name' => 'Air Terminal Konvensional Split Point', 'slug' => 'air-terminal-konvensional-split-point', 'description' => 'Air terminal konvensional split point berkualitas tinggi dengan material tembaga berlapis nikel. Desain split point memudahkan instalasi dan perawatan. Ideal untuk bangunan residensial dan komersial kelas menengah.', 'specification' => "Tipe: Konvensional Split Point\nMaterial: Tembaga Berlapis Nikel\nTinggi: 1.5 meter\nDiameter: 16 mm\nBerat: 2.3 kg\nStandar: SNI 04-0225-2000", 'featured' => false, 'order' => 2],
            ['category_slug' => 'air-terminal', 'name' => 'Air Terminal Franklin Rod Tembaga', 'slug' => 'air-terminal-franklin-rod', 'description' => 'Air terminal model Franklin rod klasik dari tembaga murni. Desain sederhana namun sangat efektif untuk proteksi petir pada bangunan standar. Tersedia dalam berbagai ukuran sesuai kebutuhan.', 'specification' => "Tipe: Franklin Rod\nMaterial: Tembaga Murni 99.9%\nTinggi: 1 meter / 1.5 meter / 2 meter\nDiameter: 14 mm / 16 mm\nBerat: mulai 1.8 kg\nStandar: SNI", 'featured' => false, 'order' => 3],
            ['category_slug' => 'air-terminal', 'name' => 'Air Terminal Multifunction Industrial', 'slug' => 'air-terminal-multifunction-industrial', 'description' => 'Air terminal industrial multifungsi yang terintegrasi dengan sensor cuaca dan monitoring system. Cocok untuk gedung pencakar langit, menara telekomunikasi, dan instalasi industri berat.', 'specification' => "Tipe: Multifunction Smart Terminal\nMaterial: Stainless Steel 304 + Tembaga\nSensor Terintegrasi: Cuaca, Suhu, Kelembaban\nOutput Data: RS485 / Wireless\nIP Rating: IP68\nBerat: 12 kg\nGaransi: 7 tahun", 'featured' => true, 'order' => 4],

            // Kabel Konduktor
            ['category_slug' => 'kabel-konduktor', 'name' => 'Kabel BC (Bare Copper) 50 mm²', 'slug' => 'kabel-bc-50mm', 'description' => 'Kabel tembaga telanjang (Bare Copper) 50 mm² berkualitas tinggi untuk konduktor penyalur arus petir. Fleksibel, tahan korosi, dan memiliki konduktivitas listrik optimal.', 'specification' => "Tipe: BC (Bare Copper)\nLuas Penampang: 50 mm²\nMaterial: Tembaga Elektrolitik 99.9%\nJumlah Serat: 7 serat\nDiameter: 9 mm\nBerat: 0.45 kg/m\nTegangan Putus: >4.5 kN\nStandar: IEC 61089, SNI", 'featured' => true, 'order' => 5],
            ['category_slug' => 'kabel-konduktor', 'name' => 'Kabel BC 70 mm² Heavy Duty', 'slug' => 'kabel-bc-70mm-heavy-duty', 'description' => 'Kabel BC 70 mm² heavy duty untuk instalasi dengan kebutuhan konduktivitas tinggi. Cocok untuk bangunan industri besar, pabrik kimia, dan area dengan resiko petir tinggi.', 'specification' => "Tipe: BC Heavy Duty\nLuas Penampang: 70 mm²\nMaterial: Tembaga Elektrolitik\nJumlah Serat: 19 serat\nDiameter: 11 mm\nBerat: 0.62 kg/m\nStandar: IEC, SNI", 'featured' => false, 'order' => 6],
            ['category_slug' => 'kabel-konduktor', 'name' => 'Kabel NYA PVC Insulated 16 mm²', 'slug' => 'kabel-nya-16mm', 'description' => 'Kabel NYA berisolasi PVC 16 mm² untuk instalasi grounding dan interkoneksi sistem penangkal petir. Isolasi PVC memberikan perlindungan tambahan terhadap lingkungan korosif.', 'specification' => "Tipe: NYA / PVC Insulated\nLuas Penampang: 16 mm²\nMaterial Konduktor: Tembaga\nIsolasi: PVC Hitam\nTegangan Kerja: 450/750 V\nBerat: 0.18 kg/m\nStandar: SNI 04-6629-2001", 'featured' => false, 'order' => 7],
            ['category_slug' => 'kabel-konduktor', 'name' => 'Kabel Tinned Copper Braided 25 mm²', 'slug' => 'kabel-tinned-copper-braided-25mm', 'description' => 'Kabel jalinan tembaga kaleng (tinned copper braided) 25 mm² yang fleksibel dan tahan korosi. Sangat cocok untuk instalasi di lingkungan laut, pesisir, dan area dengan kadar garam tinggi.', 'specification' => "Tipe: Tinned Copper Braided\nLuas Penampang: 25 mm²\nMaterial: Tembaga Kaleng\nKonstruksi: Jalinan (Braided)\nLebar: 20 mm\nKetebalan: 2.5 mm\nBerat: 0.22 kg/m\nKelebihan: Anti karat, fleksibel tinggi", 'featured' => true, 'order' => 8],

            // Grounding System
            ['category_slug' => 'grounding-system', 'name' => 'Ground Rod Tembaga 5/8″ x 4 Meter', 'slug' => 'ground-rod-tembaga-5-8-x-4m', 'description' => 'Ground rod (elektroda pembumian) tembaga murni diameter 5/8 inch panjang 4 meter. Dilengkapi ulir dan konektor untuk sambungan yang kokoh. Memberikan resistansi pembumian optimal.', 'specification' => "Diameter: 5/8 inch (16 mm)\nPanjang: 4 meter\nMaterial: Tembaga Murni 99.9%\nPelapisan: Copper Bonded 254 mikron\nThread: UNC 5/8\"\nBerat: 6.3 kg\nStandar: IEEE 80, SNI", 'featured' => true, 'order' => 9],
            ['category_slug' => 'grounding-system', 'name' => 'Ground Rod Stainless Steel 3/4″ x 3 Meter', 'slug' => 'ground-rod-stainless-3-4-x-3m', 'description' => 'Ground rod stainless steel 304 untuk kondisi tanah korosif dan lingkungan kimia. Cocok untuk pabrik kimia, kilang minyak, dan instalasi marine.', 'specification' => "Diameter: 3/4 inch (19 mm)\nPanjang: 3 meter\nMaterial: Stainless Steel 304\nThread: UNC 3/4\"\nBerat: 5.1 kg\nStandar: ASTM A276", 'featured' => false, 'order' => 10],
            ['category_slug' => 'grounding-system', 'name' => 'Chemical Grounding Rod Set', 'slug' => 'chemical-grounding-rod-set', 'description' => 'Set chemical grounding rod lengkap dengan bahan kimia pengurang resistansi tanah. Solusi untuk area dengan kondisi tanah berbatu, tanah kering, atau resistansi tinggi. Mencakup rod, konektor, dan chemical compound.', 'specification' => "Panjang Rod: 3 meter\nMaterial Rod: Tembaga Berlubang\nDiameter: 60 mm\nChemical Compound: Bentonite + Carbon\nBerat Total: 35 kg\nCakupan: Radius 5 meter\nResistansi Target: <1 Ohm\nGaransi: 10 tahun", 'featured' => true, 'order' => 11],
            ['category_slug' => 'grounding-system', 'name' => 'Grounding Plate Tembaga 600×600 mm', 'slug' => 'grounding-plate-tembaga-600x600', 'description' => 'Plat grounding tembaga murni ukuran 600×600 mm untuk sistem pembumian pada area terbatas. Efektif untuk grounding system pada gardu listrik, panel kontrol, dan menara telekomunikasi.', 'specification' => "Material: Tembaga Murni\nUkuran: 600 x 600 mm\nKetebalan: 3 mm / 4 mm / 6 mm\nBerat: 9.6 kg (tebal 3 mm)\nKonektor: 2 x 20 mm bolt hole\nStandar: IEC 62305", 'featured' => false, 'order' => 12],

            // SPD
            ['category_slug' => 'spd', 'name' => 'SPD Type 1 (Class I) 100 kA 4P', 'slug' => 'spd-type-1-100ka-4p', 'description' => 'Surge Protection Device Type 1 (Class I) dengan kapasitas 100 kA per kutub. Dirancang untuk melindungi instalasi listrik utama dari sambaran petir langsung. Cocok untuk panel distribusi utama bangunan.', 'specification' => "Tipe: Type 1 (Class I)\nMax Discharge Current (Imax): 100 kA (10/350 µs)\nNominal Voltage: 230/400 V AC\nKonfigurasi: 4P (3P+N)\nProtection Level (Up): ≤1.5 kV\nResponse Time: <25 ns\nIP Rating: IP20\nStandar: IEC 61643-11, EN 50539-11", 'featured' => true, 'order' => 13],
            ['category_slug' => 'spd', 'name' => 'SPD Type 2 (Class II) 40 kA 4P', 'slug' => 'spd-type-2-40ka-4p', 'description' => 'SPD Type 2 (Class II) 40 kA untuk proteksi lonjakan pada panel sub-distribusi dan peralatan elektronik sensitif. Perlindungan optimal untuk AC, pompa, lift, dan peralatan elektronik gedung.', 'specification' => "Tipe: Type 2 (Class II)\nMax Discharge Current: 40 kA (8/20 µs)\nNominal Voltage: 230/400 V AC\nKonfigurasi: 4P (3P+N)\nProtection Level (Up): ≤1.2 kV\nResponse Time: <25 ns\nThermal Protection: Ya\nIndikator Status: Visual + Remote\nStandar: IEC 61643-11", 'featured' => false, 'order' => 14],
            ['category_slug' => 'spd', 'name' => 'SPD Type 3 (Class III) 20 kA 2P', 'slug' => 'spd-type-3-20ka-2p', 'description' => 'SPD Type 3 (Class III) untuk proteksi terminal akhir peralatan elektronik sensitif. Ideal untuk melindungi CCTV, komputer, server, dan perangkat telekomunikasi dari lonjakan tegangan sisa.', 'specification' => "Tipe: Type 3 (Class III)\nMax Discharge Current: 20 kA (8/20 µs)\nNominal Voltage: 230 V AC\nKonfigurasi: 2P (1P+N)\nProtection Level (Up): ≤1.0 kV\nResponse Time: <5 ns\nFilter: EMI/RFI Filter\nProtector: Ya\nStandar: IEC 61643-11", 'featured' => false, 'order' => 15],
            ['category_slug' => 'spd', 'name' => 'SPD untuk Solar PV 1500V DC', 'slug' => 'spd-solar-pv-1500v-dc', 'description' => 'SPD khusus untuk sistem Solar PV (Photovoltaic) dengan tegangan DC hingga 1500V. Melindungi panel surya, inverter, dan sistem penyimpanan energi dari lonjakan petir induksi.', 'specification' => "Tipe: DC PV SPD\nMax Voltage: 1500V DC\nDischarge Current: 40 kA (8/20 µs)\nProtection Level: ≤3.5 kV\nResponse Time: <25 ns\nKonfigurasi: 2P DC\nIP Rating: IP65 (outdoor)\nStandar: IEC 61643-31, EN 50539-11", 'featured' => true, 'order' => 16],

            // Aksesoris
            ['category_slug' => 'aksesoris-instalasi', 'name' => 'Konektor BC Tee Clamp', 'slug' => 'konektor-bc-tee-clamp', 'description' => 'Konektor tee clamp untuk sambungan kabel BC (Bare Copper) dalam konfigurasi T (tee). Material kuningan berkualitas tinggi dengan baut stainless anti karat.', 'specification' => "Material: Kuningan / Brass\nRange Kabel: 16-70 mm²\nBaut: Stainless Steel M10\nCoating: Nickel Plated\nBerat: 0.3 kg\nStandar: IEC 62561", 'featured' => false, 'order' => 17],
            ['category_slug' => 'aksesoris-instalasi', 'name' => 'Bracket Dinding Stainless Steel', 'slug' => 'bracket-dinding-stainless', 'description' => 'Bracket dinding stainless steel untuk pemasangan kabel konduktor pada dinding bangunan. Desain ergonomis dengan jarak 50 mm dari permukaan dinding.', 'specification' => "Material: Stainless Steel 304\nJarak dari Dinding: 50 mm\nType: Wall Mount\nKapasitas Kabel: hingga 70 mm²\nBerat: 0.15 kg\nJarak Antar Bracket: 1 meter (rekomendasi)", 'featured' => false, 'order' => 18],
            ['category_slug' => 'aksesoris-instalasi', 'name' => 'Test Joint / Sambungan Uji', 'slug' => 'test-joint-sambungan-uji', 'description' => 'Test joint untuk pengukuran resistansi sistem penangkal petir secara berkala. Memudahkan teknisi melakukan pengukuran tanpa membongkar instalasi.', 'specification' => "Material: Kuningan + Tembaga\nRange Kabel: 16-70 mm²\nResistansi Kontak: <0.1 mOhm\nIP Rating: IP54\nBerat: 0.25 kg\nFitur: Bisa dibuka/tutup", 'featured' => false, 'order' => 19],
            ['category_slug' => 'aksesoris-instalasi', 'name' => 'Exothermic Welding Kit', 'slug' => 'exothermic-welding-kit', 'description' => 'Kit las exothermic (thermit welding) untuk sambungan permanen antara konduktor tembaga dengan ground rod atau antar sesama konduktor. Memberikan sambungan yang kuat dan tahan lama.', 'specification' => "Tipe: Exothermic Welding\nMaterial: Copper Oxide + Aluminum\nTemperatur: >2000°C\nWaktu Reaksi: 3-5 detik\nKapasitas Sambungan: hingga 120 mm²\nIsi: 10 kapsul + crucible + striker", 'featured' => true, 'order' => 20],

            // Equipment
            ['category_slug' => 'equipment-tools', 'name' => 'Earth Tester Digital Kyoritsu 4105A', 'slug' => 'earth-tester-kyoritsu-4105a', 'description' => 'Alat ukur resistansi pembumian (earth tester) digital Kyoritsu 4105A. Akurat, mudah digunakan, dilengkapi dengan data hold dan auto power off. Wajib untuk teknisi penangkal petir.', 'specification' => "Merk: Kyoritsu\nModel: 4105A\nRange: 0-2000 ohm (3 range)\nAkurasi: ±2% rdg ± 0.1 ohm\nResolusi: 0.01 ohm\nMetode: Fall of Potential\nFitur: Data Hold, Auto Power Off\nPower: 6 x AA Battery\nStandar: IEC 61010-1", 'featured' => true, 'order' => 21],
            ['category_slug' => 'equipment-tools', 'name' => 'Clamp Meter Surge Arrester Tester', 'slug' => 'clamp-meter-surge-tester', 'description' => 'Clamp meter khusus untuk pengukuran arus bocor pada surge arrester dan SPD. Non-invasif, cukup dijepitkan pada kabel grounding untuk membaca arus bocor.', 'specification' => "Tipe: Clamp Meter AC/DC\nRange Arus: 0-100 A AC\nResolusi: 0.1 mA\nRange Tegangan: 0-600 V\nJepitan: 32 mm\nFitur: Peak Hold, Data Logging\nPower: 9V Battery\nStandar: IEC 61010-1 CAT III", 'featured' => false, 'order' => 22],
        ];

        foreach ($products as $product) {
            $categoryId = null;
            if (isset($catIds[$product['category_slug']])) {
                $categoryId = $catIds[$product['category_slug']];
            }

            Product::create([
                'category_id' => $categoryId,
                'name' => $product['name'],
                'slug' => $product['slug'],
                'description' => $product['description'],
                'specification' => $product['specification'],
                'featured' => $product['featured'],
                'order' => $product['order'],
            ]);
        }

        $this->command?->info('Created ' . count($products) . ' products in ' . ProductCategory::count() . ' categories.');
    }

    private function seedProjectCategories(): void
    {
        $categories = [
            ['name' => 'Gedung Komersial', 'slug' => 'gedung-komersial', 'description' => 'Proyek proteksi petir untuk gedung perkantoran, mall, dan pusat perbelanjaan.', 'order' => 1],
            ['name' => 'Industri & Pabrik', 'slug' => 'industri-pabrik', 'description' => 'Proyek proteksi petir untuk kawasan industri dan pabrik.', 'order' => 2],
            ['name' => 'Residensial', 'slug' => 'residensial', 'description' => 'Proyek proteksi petir untuk perumahan, apartemen, dan villa.', 'order' => 3],
            ['name' => 'Infrastruktur Publik', 'slug' => 'infrastruktur-publik', 'description' => 'Proyek proteksi petir untuk fasilitas publik, rumah sakit, sekolah, dan pemerintahan.', 'order' => 4],
            ['name' => 'Telekomunikasi & Energi', 'slug' => 'telekomunikasi-energi', 'description' => 'Proyek proteksi petir untuk menara BTS, gardu listrik, dan pembangkit energi.', 'order' => 5],
        ];

        foreach ($categories as $cat) {
            ProjectCategory::create($cat);
        }
    }

    private function seedProjects(): void
    {
        $catIds = ProjectCategory::pluck('id', 'slug');

        $projects = [
            // Gedung Komersial
            ['category_slug' => 'gedung-komersial', 'title' => 'Instalasi Penangkal Petir Gedung Graha Pena Surabaya', 'slug' => 'graha-pena-surabaya', 'location' => 'Surabaya, Jawa Timur', 'year' => '2024', 'client' => 'PT Graha Pena', 'description' => 'Proyek instalasi sistem proteksi petir eksternal dan internal pada gedung perkantoran 22 lantai. Meliputi pemasangan 4 unit air terminal ESE, kabel konduktor BC 70 mm² sepanjang 1.200 meter, grounding system dengan resistansi <1 ohm, dan SPD Type 1 & 2 di seluruh panel distribusi.', 'featured' => true],
            ['category_slug' => 'gedung-komersial', 'title' => 'Sistem Proteksi Petir Trans Icon Mall Surabaya', 'slug' => 'trans-icon-mall', 'location' => 'Surabaya, Jawa Timur', 'year' => '2024', 'client' => 'PT Trans Retail Indonesia', 'description' => 'Pemasangan sistem proteksi petir komprehensif untuk pusat perbelanjaan 5 lantai. Menggunakan 6 unit air terminal ESE untuk cakupan optimal, grounding rod tembaga 5/8" sebanyak 12 titik, dan SPD Type 2 untuk proteksi seluruh panel listrik tenant.', 'featured' => true],
            ['category_slug' => 'gedung-komersial', 'title' => 'Proteksi Petir Gedung DPRD Jawa Timur', 'slug' => 'gedung-dprd-jatim', 'location' => 'Surabaya, Jawa Timur', 'year' => '2023', 'client' => 'Pemerintah Provinsi Jawa Timur', 'description' => 'Instalasi sistem penangkal petir untuk gedung pemerintahan 8 lantai. Meliputi 2 unit air terminal ESE, kabel BC 50 mm², sistem grounding komprehensif, dan SPD Type 1 di panel utama.', 'featured' => false],
            ['category_slug' => 'gedung-komersial', 'title' => 'Sistem Proteksi Petir Kantor Bupati Gresik', 'slug' => 'kantor-bupati-gresik', 'location' => 'Gresik, Jawa Timur', 'year' => '2023', 'client' => 'Pemerintah Kabupaten Gresik', 'description' => 'Pemasangan sistem penangkal petir untuk gedung perkantoran pemerintahan 6 lantai. Dilengkapi dengan sistem monitoring dan SPD untuk proteksi peralatan elektronik vital.', 'featured' => false],

            // Industri & Pabrik
            ['category_slug' => 'industri-pabrik', 'title' => 'Proteksi Petir Pabrik Semen Gresik Tuban', 'slug' => 'pabrik-semen-gresik-tuban', 'location' => 'Tuban, Jawa Timur', 'year' => '2024', 'client' => 'PT Semen Indonesia (Persero) Tbk', 'description' => 'Proyek besar proteksi petir untuk area pabrik seluas 50 hektar. Meliputi pemasangan 15 unit air terminal ESE, kabel konduktor BC 70 mm² total 3.500 meter, grounding system dengan chemical treatment di 30 titik, dan ratusan SPD untuk panel kontrol dan MCC.', 'featured' => true],
            ['category_slug' => 'industri-pabrik', 'title' => 'Instalasi Penangkal Petir Pabrik Makanan PT Nestle Kejayan', 'slug' => 'pabrik-nestle-kejayan', 'location' => 'Pasuruan, Jawa Timur', 'year' => '2024', 'client' => 'PT Nestle Indonesia', 'description' => 'Pemasangan sistem proteksi petir untuk pabrik makanan skala internasional dengan standar ketat. Sistem mencakup proteksi eksternal + internal lengkap dengan SPD untuk seluruh panel dan peralatan produksi sensitif.', 'featured' => true],
            ['category_slug' => 'industri-pabrik', 'title' => 'Sistem Grounding & Proteksi Petir Pabrik Petrokimia', 'slug' => 'pabrik-petrokimia-gresik', 'location' => 'Gresik, Jawa Timur', 'year' => '2023', 'client' => 'PT Petrokimia Gresik', 'description' => 'Proyek grounding dan proteksi petir untuk area pabrik pupuk. Memasang grounding system dengan resistansi <0.5 ohm menggunakan chemical grounding rod, air terminal ESE, dan SPD industrial grade.', 'featured' => false],
            ['category_slug' => 'industri-pabrik', 'title' => 'Proteksi Petir Gudang Logistik BUMN', 'slug' => 'gudang-logistik-bumn', 'location' => 'Sidoarjo, Jawa Timur', 'year' => '2023', 'client' => 'Perusahaan BUMN Logistik', 'description' => 'Instalasi penangkal petir untuk gudang logistik seluas 20.000 m². Sistem mencakup 4 unit air terminal, kabel konduktor, grounding 6 titik, dan SPD untuk panel utama dan sub-panel.', 'featured' => false],

            // Residensial
            ['category_slug' => 'residensial', 'title' => 'Sistem Penangkal Petir Perumahan CitraLand CBD Sidoarjo', 'slug' => 'citraland-cbd-sidoarjo', 'location' => 'Sidoarjo, Jawa Timur', 'year' => '2024', 'client' => 'PT Ciputra Development Tbk', 'description' => 'Pemasangan sistem proteksi petir untuk 150 unit rumah di cluster premium. Setiap unit dilengkapi air terminal Franklin rod, kabel BC 25 mm², dan grounding rod tembaga. Desain estetik menyatu dengan arsitektur bangunan.', 'featured' => true],
            ['category_slug' => 'residensial', 'title' => 'Proteksi Petir Apartemen Gunawangsa Mer', 'slug' => 'apartemen-gunawangsa-mer', 'location' => 'Surabaya, Jawa Timur', 'year' => '2023', 'client' => 'PT Gunawangsa Jaya', 'description' => 'Instalasi sistem penangkal petir untuk apartemen 20 lantai. Menggunakan 3 unit air terminal ESE, kabel BC 50 mm², dan grounding system dengan resistansi <2 ohm. Proteksi SPD untuk seluruh panel apartemen.', 'featured' => false],
            ['category_slug' => 'residensial', 'title' => 'Instalasi Penangkal Petir Villa Bukit Golf Sidoarjo', 'slug' => 'villa-bukit-golf-sidoarjo', 'location' => 'Sidoarjo, Jawa Timur', 'year' => '2023', 'client' => 'Pengembang Perumahan', 'description' => 'Pemasangan sistem proteksi petir untuk 25 unit villa eksklusif. Desain tersembunyi (concealed) dengan air terminal minimalis, kabel dalam pipa PVC, dan grounding rod yang tidak mengganggu estetika taman.', 'featured' => false],

            // Infrastruktur Publik
            ['category_slug' => 'infrastruktur-publik', 'title' => 'Sistem Proteksi Petir RS Premier Surabaya', 'slug' => 'rs-premier-surabaya', 'location' => 'Surabaya, Jawa Timur', 'year' => '2024', 'client' => 'RS Premier Surabaya', 'description' => 'Proteksi petir komprehensif untuk rumah sakit 10 lantai. Prioritas pada keamanan pasien dan peralatan medis sensitif. Sistem mencakup ESE air terminal, grounding dengan resistansi <1 ohm, dan SPD bertingkat (Type 1, 2, 3) untuk semua peralatan medis.', 'featured' => true],
            ['category_slug' => 'infrastruktur-publik', 'title' => 'Proteksi Petir Kampus Universitas Airlangga', 'slug' => 'kampus-unair', 'location' => 'Surabaya, Jawa Timur', 'year' => '2023', 'client' => 'Universitas Airlangga', 'description' => 'Instalasi sistem proteksi petir untuk 5 gedung fakultas dan laboratorium. Dilengkapi dengan sistem grounding laboratorium khusus dengan standar <0.5 ohm untuk peralatan penelitian sensitif.', 'featured' => true],
            ['category_slug' => 'infrastruktur-publik', 'title' => 'Instalasi Penangkal Petir Stadion Gelora Delta', 'slug' => 'stadion-gelora-delta', 'location' => 'Sidoarjo, Jawa Timur', 'year' => '2023', 'client' => 'Pemerintah Kabupaten Sidoarjo', 'description' => 'Pemasangan sistem proteksi petir untuk stadion utama dengan kapasitas 30.000 penonton. Menggunakan 8 unit air terminal ESE distribusi strategis, kabel BC 70 mm², dan grounding system dengan 20 titik pembumian.', 'featured' => false],

            // Telekomunikasi & Energi
            ['category_slug' => 'telekomunikasi-energi', 'title' => 'Proteksi Petir Menara BTS Telkomsel Jawa Timur', 'slug' => 'menara-bts-telkomsel', 'location' => 'Jawa Timur (20 titik)', 'year' => '2024', 'client' => 'PT Telkomsel', 'description' => 'Proyek pemasangan sistem proteksi petir untuk 20 menara BTS di berbagai lokasi di Jawa Timur. Setiap menara dilengkapi air terminal, kabel down conductor, grounding system, dan SPD untuk peralatan telekomunikasi.', 'featured' => true],
            ['category_slug' => 'telekomunikasi-energi', 'title' => 'Sistem Grounding Gardu Induk PLN 150 kV', 'slug' => 'gardu-induk-pln-150kv', 'location' => 'Sidoarjo, Jawa Timur', 'year' => '2024', 'client' => 'PT PLN (Persero)', 'description' => 'Instalasi sistem grounding dan proteksi petir untuk gardu induk tegangan 150 kV. Menggunakan grounding grid kabel BC 70 mm² total 2.800 meter, ground rod 24 titik, dan chemical treatment untuk mencapai resistansi <0.5 ohm.', 'featured' => true],
            ['category_slug' => 'telekomunikasi-energi', 'title' => 'Proteksi Petir PLTS Atap Pabrik 5 MWp', 'slug' => 'plts-atap-pabrik-5mwp', 'location' => 'Gresik, Jawa Timur', 'year' => '2023', 'client' => 'Perusahaan EPC Solar', 'description' => 'Pemasangan sistem proteksi petir untuk pembangkit listrik tenaga surya atap 5 MWp. Menggunakan SPD khusus DC PV 1500V di setiap string combiner box, grounding system, dan proteksi eksternal untuk area panel surya.', 'featured' => false],
        ];

        foreach ($projects as $project) {
            $categoryId = null;
            if (isset($catIds[$project['category_slug']])) {
                $categoryId = $catIds[$project['category_slug']];
            }

            Project::create([
                'category_id' => $categoryId,
                'title' => $project['title'],
                'slug' => $project['slug'],
                'location' => $project['location'],
                'year' => $project['year'],
                'client' => $project['client'],
                'description' => $project['description'],
                'featured' => $project['featured'],
            ]);
        }

        $this->command?->info('Created ' . count($projects) . ' projects in ' . ProjectCategory::count() . ' categories.');
    }

    private function seedArticleCategories(): void
    {
        $categories = [
            ['name' => 'Teknologi', 'slug' => 'teknologi', 'description' => 'Artikel tentang teknologi terbaru dalam sistem proteksi petir.', 'order' => 1],
            ['name' => 'Tips & Edukasi', 'slug' => 'tips-edukasi', 'description' => 'Tips dan edukasi seputar sistem proteksi petir.', 'order' => 2],
            ['name' => 'Standar & Regulasi', 'slug' => 'standar-regulasi', 'description' => 'Informasi tentang standar dan regulasi proteksi petir.', 'order' => 3],
            ['name' => 'Studi Kasus', 'slug' => 'studi-kasus', 'description' => 'Studi kasus implementasi sistem proteksi petir.', 'order' => 4],
            ['name' => 'Berita Perusahaan', 'slug' => 'berita-perusahaan', 'description' => 'Berita dan aktivitas terkini DJAJA MANDIRI TEKNIK.', 'order' => 5],
        ];

        foreach ($categories as $cat) {
            ArticleCategory::create($cat);
        }
    }

    private function seedArticles(): void
    {
        $catIds = ArticleCategory::pluck('id', 'slug');

        $articles = [
            // Teknologi
            ['category_slug' => 'teknologi', 'title' => 'Mengenal Teknologi Early Streamer Emission (ESE) untuk Proteksi Petir Modern', 'slug' => 'mengenal-teknologi-ese', 'excerpt' => 'Pelajari bagaimana teknologi ESE bekerja dan mengapa menjadi pilihan utama untuk proteksi petir gedung bertingkat dan area industri luas.', 'content' => "<h2>Apa itu Teknologi ESE?</h2><p>Early Streamer Emission (ESE) adalah teknologi air terminal yang mampu memicu pelepasan muatan (streamer) lebih awal dibandingkan dengan terminal konvensional (Franklin rod). Prinsip kerjanya memanfaatkan perbedaan potensial listrik di udara untuk menciptakan jalur ionisasi yang mempercepat proses penangkapan sambaran petir.</p><h2>Bagaimana Cara Kerjanya?</h2><p>Saat awan bermuatan listrik mendekati bangunan, medan listrik di sekitar terminal ESE meningkat secara drastis. Terminal ESE secara aktif memancarkan pulsa ionik yang menciptakan jalur konduktif menuju awan, sehingga sambaran petir dapat diarahkan dan dikendalikan dengan presisi tinggi.</p><h2>Keunggulan ESE</h2><ul><li><strong>Jangkauan lebih luas</strong> — Satu unit ESE dapat melindungi area hingga radius 150 meter</li><li><strong>Respon lebih cepat</strong> — Memicu pelepasan muatan lebih awal dari konvensional</li><li><strong>Efisiensi biaya</strong> — Lebih sedikit unit diperlukan, mengurangi biaya instalasi dan perawatan</li><li><strong>Estetika bangunan</strong> — Desain lebih minimalis dan modern</li></ul><h2>Aplikasi ESE</h2><p>Teknologi ESE sangat cocok untuk gedung perkantoran, pusat perbelanjaan, pabrik, rumah sakit, sekolah, dan berbagai bangunan dengan area atap yang luas.</p>", 'tags' => ['ESE', 'air terminal', 'penangkal petir', 'teknologi proteksi'], 'read_time' => 5, 'status' => 'published', 'published_at' => '2025-10-15 08:00:00'],
            ['category_slug' => 'teknologi', 'title' => 'Perbedaan SPD Type 1, Type 2, dan Type 3 — Mana yang Anda Butuhkan?', 'slug' => 'perbedaan-spd-type-1-2-3', 'excerpt' => 'Pahami perbedaan fungsi dan aplikasi dari masing-masing tipe Surge Protection Device untuk proteksi peralatan listrik yang optimal.', 'content' => "<h2>Apa itu SPD?</h2><p>Surge Protection Device (SPD) adalah alat yang melindungi instalasi listrik dan peralatan elektronik dari lonjakan tegangan transien (surge) yang disebabkan oleh sambaran petir atau switching listrik.</p><h2>Tiga Tipe SPD</h2><h3>Type 1 (Class I) — Proteksi Utama</h3><p>Dipasang di panel distribusi utama rumah/bangunan. Mampu menahan arus petir langsung 10/350 µs hingga 100 kA. Berfungsi sebagai lini pertama pertahanan terhadap sambaran petir langsung.</p><h3>Type 2 (Class II) — Proteksi Menengah</h3><p>Dipasang di panel sub-distribusi. Menahan arus 8/20 µs hingga 40 kA. Melindungi dari sisa lonjakan yang tidak tertangani SPD Type 1 dan switching surge internal.</p><h3>Type 3 (Class III) — Proteksi Akhir</h3><p>Dipasang langsung di dekat peralatan sensitif (komputer, server, CCTV). Respon sangat cepat (<5 ns). Melindungi dari sisa lonjakan tegangan yang sangat kecil.</p><h2>Kombinasi Optimal</h2><p>Sistem proteksi yang ideal menggunakan kombinasi ketiga tipe secara berjenjang (cascade). Hal ini memastikan perlindungan maksimal dari sambaran petir langsung hingga perangkat elektronik paling sensitif sekalipun.</p>", 'tags' => ['SPD', 'surge protection', 'proteksi lonjakan', 'type 1 type 2 type 3'], 'read_time' => 7, 'status' => 'published', 'published_at' => '2025-09-28 09:00:00'],
            ['category_slug' => 'teknologi', 'title' => 'Sistem Grounding dengan Chemical Rod — Solusi Tanah Resistansi Tinggi', 'slug' => 'grounding-chemical-rod', 'excerpt' => 'Solusi efektif untuk mencapai resistansi grounding rendah di area dengan kondisi tanah berbatu atau resistansi tinggi.', 'content' => "<h2>Tantangan Tanah Resistansi Tinggi</h2><p>Di banyak lokasi, terutama daerah berbatu, tanah kering, atau tanah pasir, resistansi tanah bisa sangat tinggi (>100 ohm). Standar internasional mensyaratkan resistansi grounding <5 ohm, idealnya <1 ohm.</p><h2>Apa itu Chemical Grounding Rod?</h2><p>Chemical grounding rod adalah elektroda pembumian berongga yang diisi dengan bahan kimia khusus (biasanya campuran bentonite dan carbon). Bahan kimia ini menyerap kelembaban dari udara dan merembes keluar melalui lubang-lubang pada rod, menciptakan zona konduktif di sekitar elektroda.</p><h2>Keunggulan Chemical Rod</h2><ul><li>Menurunkan resistansi secara signifikan hingga <1 ohm</li><li>Efektif di semua jenis tanah, termasuk berbatu</li><li>Masa pakai panjang (10+ tahun)</li><li>Perawatan minimal</li></ul><p>DJAJA MANDIRI TEKNIK menyediakan jasa instalasi chemical grounding rod lengkap dengan garansi hasil hingga 10 tahun.</p>", 'tags' => ['chemical grounding', 'grounding rod', 'resistansi tanah', 'pembumian'], 'read_time' => 6, 'status' => 'published', 'published_at' => '2025-09-10 10:00:00'],

            // Tips & Edukasi
            ['category_slug' => 'tips-edukasi', 'title' => '5 Tanda Bangunan Anda Membutuhkan Sistem Penangkal Petir', 'slug' => '5-tanda-butuh-penangkal-petir', 'excerpt' => 'Kenali tanda-tanda bahwa bangunan Anda berisiko tinggi dan membutuhkan sistem proteksi petir yang memadai.', 'content' => "<h2>Apakah Bangunan Anda Aman?</h2><p>Banyak pemilik bangunan tidak menyadari bahwa properti mereka berisiko tinggi terhadap sambaran petir. Berikut adalah 5 tanda utama bahwa bangunan Anda membutuhkan sistem penangkal petir:</p><h3>1. Bangunan Tinggi (>15 meter)</h3><p>Semakin tinggi bangunan, semakin besar kemungkinan tersambar petir. Bangunan dengan ketinggian di atas 15 meter (setara 3-4 lantai) wajib memiliki proteksi petir sesuai standar SNI 03-7015-2004.</p><h3>2. Area dengan Frekuensi Petir Tinggi (IKL >100)</h3><p>Indonesia memiliki salah satu frekuensi petir tertinggi di dunia. Daerah seperti Jawa Barat, Jawa Tengah, dan Sumatera memiliki IKL (Isokeraunic Level) >100 hari petir per tahun.</p><h3>3. Bangunan dengan Peralatan Elektronik Mahal</h3><p>Rumah sakit, data center, laboratorium, dan kantor dengan peralatan elektronik sensitif sangat rentan terhadap kerusakan akibat lonjakan petir induksi.</p><h3>4. Lokasi Terbuka / Area Luas</h3><p>Bangunan di area terbuka seperti lapangan, bukit, atau area industri tanpa bangunan tinggi di sekitarnya memiliki risiko sambaran lebih tinggi.</p><h3>5. Bangunan Tua Tanpa Proteksi</h3><p>Banyak bangunan lama dibangun tanpa sistem proteksi petir. Jika bangunan Anda berusia >20 tahun dan belum memiliki proteksi petir, segera lakukan konsultasi.</p>", 'tags' => ['tips', 'edukasi', 'proteksi petir', 'keselamatan bangunan'], 'read_time' => 4, 'status' => 'published', 'published_at' => '2025-08-20 08:30:00'],
            ['category_slug' => 'tips-edukasi', 'title' => 'Panduan Perawatan Sistem Penangkal Petir yang Benar', 'slug' => 'panduan-perawatan-penangkal-petir', 'excerpt' => 'Rutinitas perawatan yang tepat akan memastikan sistem penangkal petir Anda berfungsi optimal sepanjang masa pakainya.', 'content' => "<h2>Pentingnya Perawatan Berkala</h2><p>Sistem penangkal petir bukanlah perangkat yang dipasang lalu dilupakan. Seperti sistem proteksi lainnya, perawatan berkala sangat penting untuk memastikan fungsi optimal saat dibutuhkan.</p><h2>Jadwal Perawatan</h2><h3>Bulanan (oleh pemilik)</h3><ul><li>Inspeksi visual air terminal — pastikan tidak bengkok atau korosi</li><li>Periksa kabel konduktor — pastikan tidak putus atau longgar</li><li>Bersihkan area sekitar air terminal dari ranting atau kotoran</li></ul><h3>Tahunan (oleh teknisi profesional)</h3><ul><li>Pengukuran resistansi grounding dengan earth tester</li><li>Inspeksi menyeluruh seluruh komponen sistem</li><li>Pengencangan baut dan konektor</li><li>Pengecekan SPD dan indikator statusnya</li></ul><h3>5 Tahunan (overhaul)</h3><ul><li>Penggantian chemical grounding jika diperlukan</li><li>Pengukuran dan evaluasi sistem secara komprehensif</li><li>Sertifikasi ulang sistem</li></ul><h2>Biaya Perawatan</h2><p>Biaya perawatan tahunan umumnya hanya 2-5% dari biaya instalasi awal. Investasi kecil untuk keamanan bangunan dan aset Anda.</p>", 'tags' => ['perawatan', 'maintenance', 'penangkal petir', 'tips perawatan'], 'read_time' => 5, 'status' => 'published', 'published_at' => '2025-07-15 09:00:00'],
            ['category_slug' => 'tips-edukasi', 'title' => 'Cara Menghitung Kebutuhan Grounding untuk Bangunan', 'slug' => 'cara-menghitung-kebutuhan-grounding', 'excerpt' => 'Panduan sederhana menghitung kebutuhan sistem grounding berdasarkan ukuran, fungsi, dan kondisi tanah bangunan Anda.', 'content' => "<h2>Mengapa Grounding Penting?</h2><p>Sistem grounding (pembumian) adalah komponen paling krusial dalam sistem proteksi petir. Tanpa grounding yang baik, air terminal terbaik sekalipun tidak akan berfungsi optimal.</p><h2>Faktor yang Mempengaruhi Grounding</h2><ul><li><strong>Luas bangunan</strong> — Menentukan jumlah titik grounding yang dibutuhkan</li><li><strong>Jenis tanah</strong> — Tanah liat, pasir, atau berbatu mempengaruhi resistansi</li><li><strong>Fungsi bangunan</strong> — Rumah sakit dan data center memerlukan standar lebih ketat</li><li><strong>Tingkat proteksi</strong> — Level I, II, III, atau IV sesuai risiko</li></ul><h2>Rumus Sederhana</h2><p>Untuk bangunan standar, kebutuhan grounding dapat dihitung dengan: Jumlah ground rod = (Keliling bangunan / 20 meter) + 1. Contoh: bangunan 40×30 meter memiliki keliling 140 meter, maka minimal 8 titik ground rod.</p><p>Namun, perhitungan yang akurat memerlukan survey dan pengukuran langsung oleh teknisi berpengalaman. Hubungi DJAJA MANDIRI TEKNIK untuk konsultasi gratis!</p>", 'tags' => ['grounding', 'perhitungan', 'standar grounding', 'SNI'], 'read_time' => 4, 'status' => 'published', 'published_at' => '2025-06-05 10:30:00'],

            // Standar & Regulasi
            ['category_slug' => 'standar-regulasi', 'title' => 'Memahami SNI 03-7015-2004 tentang Sistem Proteksi Petir Bangunan', 'slug' => 'memahami-sni-03-7015-2004', 'excerpt' => 'Penjelasan lengkap tentang standar nasional Indonesia yang mengatur sistem proteksi petir pada bangunan.', 'content' => "<h2>Apa itu SNI 03-7015-2004?</h2><p>SNI 03-7015-2004 adalah Standar Nasional Indonesia tentang Tata Cara Perencanaan dan Pemasangan Sistem Proteksi Petir untuk Bangunan. Standar ini mengadopsi IEC 62305 dan menjadi acuan utama bagi kontraktor proteksi petir di Indonesia.</p><h2>Poin Penting dalam SNI</h2><h3>Klasifikasi Bangunan</h3><p>Standar mengelompokkan bangunan dalam 4 tingkat risiko (I-IV) berdasarkan fungsi, nilai aset, dan risiko sambaran petir.</p><h3>Komponen yang Diatur</h3><ul><li>Sistem proteksi eksternal (air terminal, konduktor, grounding)</li><li>Sistem proteksi internal (SPD, bonding, shielding)</li><li>Jarak aman dan radius proteksi</li><li>Material dan spesifikasi teknis</li></ul><h3>Sanksi</h3><p>Bangunan yang tidak memenuhi standar dapat dikenakan sanksi administratif dan pidana jika terjadi kerugian akibat sambaran petir.</p><h2>Konsultasi Gratis</h2><p>DJAJA MANDIRI TEKNIK siap membantu Anda merencanakan sistem proteksi petir yang sesuai standar SNI. Hubungi kami untuk konsultasi gratis!</p>", 'tags' => ['SNI', 'standar nasional', 'regulasi', 'proteksi petir'], 'read_time' => 5, 'status' => 'published', 'published_at' => '2025-05-20 08:00:00'],
            ['category_slug' => 'standar-regulasi', 'title' => 'Perbandingan Standar Proteksi Petir SNI, IEC, dan NF C', 'slug' => 'perbandingan-standar-proteksi-petir', 'excerpt' => 'Perbandingan antara standar nasional Indonesia (SNI), internasional (IEC), dan Prancis (NF C) untuk sistem proteksi petir.', 'content' => "<h2>Standar Proteksi Petir Global</h2><p>Terdapat beberapa standar yang digunakan secara global untuk sistem proteksi petir. Masing-masing memiliki keunggulan dan area aplikasi yang berbeda.</p><h3>IEC 62305 — Standar Internasional</h3><p>Standar paling luas diadopsi secara global. Mencakup proteksi eksternal, internal, dan manajemen risiko. SNI 03-7015-2004 mengadopsi standar ini.</p><h3>NF C 17-102 — Standar Prancis (ESE)</h3><p>Standar khusus untuk air terminal tipe ESE. Diakui di banyak negara termasuk Indonesia. Spesifik mengatur radius proteksi dan metode pengujian ESE.</p><h3>SNI 03-7015-2004 — Standar Indonesia</h3><p>Standar nasional yang mengadopsi IEC 62305 dengan penyesuaian kondisi Indonesia. Wajib digunakan untuk bangunan di Indonesia.</p><h2>Pilih Standar Mana?</h2><p>Untuk proyek di Indonesia, wajib menggunakan SNI sebagai acuan utama. Standar internasional digunakan sebagai referensi pelengkap untuk proyek dengan kebutuhan khusus atau persyaratan investor asing.</p>", 'tags' => ['standar internasional', 'IEC', 'NF C', 'SNI', 'perbandingan'], 'read_time' => 6, 'status' => 'published', 'published_at' => '2025-04-10 09:30:00'],

            // Studi Kasus
            ['category_slug' => 'studi-kasus', 'title' => 'Studi Kasus: Proteksi Petir Pabrik Semen Area 50 Hektar', 'slug' => 'studi-kasus-pabrik-semen', 'excerpt' => 'Bagaimana DJAJA MANDIRI TEKNIK menangani proyek proteksi petir untuk pabrik semen seluas 50 hektar di Tuban.', 'content' => "<h2>Latar Belakang</h2><p>PT Semen Indonesia (Persero) Tbk, produsen semen terbesar di Indonesia, membutuhkan sistem proteksi petir untuk pabrik barunya di Tuban, Jawa Timur. Area pabrik seluas 50 hektar dengan berbagai jenis bangunan dan peralatan produksi bernilai triliunan rupiah.</p><h2>Tantangan</h2><ul><li>Area sangat luas (50 hektar)</li><li>Kondisi tanah berbatu kapur dengan resistansi tinggi</li><li>Peralatan produksi sensitif (sistem kontrol otomatis)</li><li>Standar keamanan ketat (perusahaan publik)</li></ul><h2>Solusi</h2><ul><li>15 unit air terminal ESE dengan distribusi strategis</li><li>Kabel konduktor BC 70 mm² total 3.500 meter</li><li>30 titik grounding dengan chemical treatment</li><li>Ratusan SPD Type 1 & 2 untuk panel MCC dan kontrol</li></ul><h2>Hasil</h2><p>Resistansi grounding rata-rata <1 ohm, sistem berfungsi optimal, dan pabrik telah beroperasi selama 2 tahun tanpa insiden terkait petir.</p>", 'tags' => ['studi kasus', 'pabrik semen', 'proyek besar', 'industrial'], 'read_time' => 7, 'status' => 'published', 'published_at' => '2025-03-15 08:00:00'],
            ['category_slug' => 'studi-kasus', 'title' => 'Studi Kasus: Proteksi Petir Rumah Sakit dengan Peralatan Medis Sensitif', 'slug' => 'studi-kasus-rumah-sakit', 'excerpt' => 'Implementasi sistem proteksi petir bertingkat untuk rumah sakit dengan prioritas pada keamanan pasien dan peralatan medis.', 'content' => "<h2>Latar Belakang</h2><p>RS Premier Surabaya, rumah sakit swasta kelas A, membutuhkan upgrade sistem proteksi petir. Prioritas utama adalah melindungi peralatan medis sensitif (MRI, CT Scan, X-Ray) dan menjamin keselamatan pasien.</p><h2>Tantangan</h2><ul><li>Peralatan medis sangat sensitif terhadap lonjakan tegangan</li><li>Bangunan 10 lantai dengan berbagai fungsi</li><li>Tidak boleh ada gangguan operasional selama instalasi</li><li>Standar ketat dari Kementerian Kesehatan</li></ul><h2>Solusi</h2><ul><li>Air terminal ESE untuk proteksi eksternal</li><li>Grounding dengan resistansi <1 ohm</li><li>SPD bertingkat (Type 1, 2, 3) di seluruh panel</li><li>Proteksi khusus untuk ruang operasi dan ICU</li></ul><h2>Hasil</h2><p>Sistem berfungsi optimal tanpa mengganggu operasional rumah sakit. Peralatan medis terlindungi dari lonjakan tegangan.</p>", 'tags' => ['studi kasus', 'rumah sakit', 'peralatan medis', 'SPD'], 'read_time' => 6, 'status' => 'published', 'published_at' => '2025-02-20 10:00:00'],

            // Berita Perusahaan
            ['category_slug' => 'berita-perusahaan', 'title' => 'DJAJA MANDIRI TEKNIK Raih Kontrak Proyek Proteksi Petir PLN 150 kV', 'slug' => 'kontrak-pln-150kv', 'excerpt' => 'Kami bangga mengumumkan telah dipercaya oleh PLN untuk mengerjakan sistem grounding dan proteksi petir gardu induk 150 kV.', 'content' => "<h2>Pencapaian Baru</h2><p>DJAJA MANDIRI TEKNIK dengan bangga mengumumkan telah memenangkan tender proyek proteksi petir dan grounding untuk Gardu Induk PLN 150 kV di Sidoarjo, Jawa Timur.</p><h2>Lingkup Pekerjaan</h2><ul><li>Instalasi grounding grid dengan kabel BC 70 mm² total 2.800 meter</li><li>Pemasangan 24 titik ground rod tembaga</li><li>Chemical treatment untuk mencapai resistansi <0.5 ohm</li><li>Pemasangan SPD Type 1 untuk panel utama</li></ul><h2>Komitmen Kami</h2><p>Proyek ini menegaskan komitmen DJAJA MANDIRI TEKNIK dalam memberikan layanan terbaik untuk sektor infrastruktur ketenagalistrikan Indonesia.</p>", 'tags' => ['berita', 'PLN', 'proyek baru', 'gardu induk'], 'read_time' => 4, 'status' => 'published', 'published_at' => '2025-01-10 08:00:00'],
            ['category_slug' => 'berita-perusahaan', 'title' => 'Tim DJAJA MANDIRI TEKNIK Ikuti Sertifikasi Teknisi Proteksi Petir', 'slug' => 'sertifikasi-teknisi-proteksi-petir', 'excerpt' => 'Tim teknisi kami mengikuti program sertifikasi nasional untuk meningkatkan kompetensi di bidang sistem proteksi petir.', 'content' => "<h2>Peningkatan Kompetensi</h2><p>Sebagai komitmen terhadap kualitas layanan, 5 orang teknisi DJAJA MANDIRI TEKNIK telah mengikuti program sertifikasi teknisi proteksi petir yang diselenggarakan oleh Lembaga Sertifikasi Profesi (LSP) Ketenagalistrikan.</p><h2>Materi Sertifikasi</h2><ul><li>Perencanaan sistem proteksi petir berdasarkan SNI</li><li>Teknik instalasi yang benar</li><li>Pengukuran dan pengujian sistem</li><li>Keselamatan kerja (K3) instalasi proteksi petir</li></ul><h2>Manfaat untuk Klien</h2><p>Dengan teknisi bersertifikasi, kami menjamin kualitas instalasi yang sesuai standar, aman, dan dapat dipertanggungjawabkan secara profesional.</p>", 'tags' => ['berita', 'sertifikasi', 'teknisi', 'kompetensi'], 'read_time' => 3, 'status' => 'published', 'published_at' => '2024-12-05 09:00:00'],
        ];

        $words = ['proteksi', 'petir', 'grounding', 'SPD', 'instalasi', 'bangunan', 'keselamatan', 'standar', 'SNI', 'teknologi', 'peralatan', 'listrik', 'gedung', 'industri'];
        foreach ($articles as $article) {
            $categoryId = null;
            if (isset($catIds[$article['category_slug']])) {
                $categoryId = $catIds[$article['category_slug']];
            }

            // Add meta description if not present
            if (!isset($article['seo_description'])) {
                $article['seo_description'] = $article['excerpt'];
            }
            if (!isset($article['seo_keywords'])) {
                $article['seo_keywords'] = implode(', ', $article['tags']);
            }

            Article::create([
                'category_id' => $categoryId,
                'title' => $article['title'],
                'slug' => $article['slug'],
                'excerpt' => $article['excerpt'],
                'content' => $article['content'],
                'tags' => $article['tags'],
                'read_time' => $article['read_time'],
                'status' => $article['status'],
                'published_at' => $article['published_at'],
            ]);
        }

        $this->command?->info('Created ' . count($articles) . ' articles in ' . ArticleCategory::count() . ' categories.');
    }

    private function seedTestimonials(): void
    {
        $testimonials = [
            ['name' => 'Ir. H. Bambang Sutrisno, MT', 'position' => 'Manager Teknik', 'company' => 'PT Semen Indonesia (Persero) Tbk', 'testimonial' => 'DJAJA MANDIRI TEKNIK mengerjakan proyek proteksi petir di pabrik kami dengan sangat profesional. Tim mereka bekerja cepat, rapi, dan hasil pengukuran grounding menunjukkan resistansi yang sangat baik. Sangat direkomendasikan!', 'rating' => 5, 'order' => 1],
            ['name' => 'dr. Andi Pratama, Sp.Rad', 'position' => 'Kepala Instalasi Radiologi', 'company' => 'RS Premier Surabaya', 'testimonial' => 'Kami sangat khawatir dengan peralatan MRI dan CT Scan yang sangat sensitif terhadap lonjakan listrik. Setelah dipasangi sistem proteksi dari DJAJA MANDIRI TEKNIK, kami merasa lebih tenang. SPD bertingkat yang mereka pasang benar-benar bekerja sempurna.', 'rating' => 5, 'order' => 2],
            ['name' => 'Hendra Wijaya', 'position' => 'General Manager', 'company' => 'PT Ciputra Development Tbk', 'testimonial' => 'Sudah 3 cluster perumahan kami yang menggunakan jasa DJAJA MANDIRI TEKNIK untuk instalasi penangkal petir. Hasilnya rapi, estetik, dan sesuai standar. Harga juga kompetitif. Pasti akan terus bekerja sama.', 'rating' => 5, 'order' => 3],
            ['name' => 'Rudi Hartono', 'position' => 'Kepala Dinas PUPR', 'company' => 'Pemerintah Kabupaten Sidoarjo', 'testimonial' => 'Proyek proteksi petir Stadion Gelora Delta dan beberapa gedung pemerintah daerah kami percayakan ke DJAJA MANDIRI TEKNIK. Pengerjaan tepat waktu, sesuai spesifikasi teknis, dan garansi pelayanan yang baik.', 'rating' => 5, 'order' => 4],
            ['name' => 'Dr. Ir. Ari Wibowo, MT', 'position' => 'VP Engineering', 'company' => 'PT Trans Retail Indonesia', 'testimonial' => 'Trans Icon Mall memerlukan sistem proteksi petir yang handal. DJAJA MANDIRI TEKNIK memberikan solusi lengkap dari survey, perencanaan, instalasi, hingga commissioning. Professional dan responsif!', 'rating' => 5, 'order' => 5],
            ['name' => 'Sutikno, ST', 'position' => 'Manager Pemeliharaan', 'company' => 'PT Petrokimia Gresik', 'testimonial' => 'Penanganan grounding dan proteksi petir di pabrik kami sangat memuaskan. Chemical grounding rod yang dipasang berhasil menurunkan resistansi dari >100 ohm menjadi <1 ohm. Luar biasa!', 'rating' => 5, 'order' => 6],
            ['name' => 'Maya Sari Dewi', 'position' => 'Site Manager', 'company' => 'PT Gunawangsa Jaya', 'testimonial' => 'Apartemen 20 lantai kami butuh proteksi petir yang handal. DJAJA MANDIRI TEKNIK datang dengan solusi ESE yang efisien. Satu unit saja sudah mencakup seluruh area atap. Sangat membantu menghemat biaya.', 'rating' => 4, 'order' => 7],
            ['name' => 'Agus Prasetyo', 'position' => 'Manager Teknik', 'company' => 'PT Nestle Indonesia', 'testimonial' => 'Standar pabrik makanan global sangat ketat, termasuk untuk proteksi petir. DJAJA MANDIRI TEKNIK mampu memenuhi semua persyaratan dengan baik. Audit internal dan eksternal pun lolos.', 'rating' => 5, 'order' => 8],
            ['name' => 'Prof. Dr. Ir. Muhammad Nuh, DEA', 'position' => 'Rektor', 'company' => 'Universitas Airlangga', 'testimonial' => 'Laboratorium penelitian kami memerlukan sistem grounding dengan resistansi sangat rendah untuk peralatan riset. DJAJA MANDIRI TEKNIK berhasil memenuhi spesifikasi yang sangat ketat tersebut.', 'rating' => 5, 'order' => 9],
            ['name' => 'Dian Permata Sari, ST', 'position' => 'Project Engineer', 'company' => 'Telkomsel Regional Jatim', 'testimonial' => 'Proyek proteksi 20 menara BTS berjalan lancar. Koordinasi tim DJAJA MANDIRI TEKNIK sangat baik, mampu mengerjakan multi-site project dengan kualitas konsisten.', 'rating' => 5, 'order' => 10],
            ['name' => 'H. Ahmad Syafii', 'position' => 'Direktur', 'company' => 'CV Bangun Sarana', 'testimonial' => 'Sebagai kontraktor, kami sering bekerja sama dengan DJAJA MANDIRI TEKNIK untuk subkontrak proteksi petir. Mereka selalu on-time, kualitas bagus, dan harga bersaing. Recommended!', 'rating' => 4, 'order' => 11],
            ['name' => 'Ir. Suprapto, M.T.', 'position' => 'Manager O&M', 'company' => 'PLN UP3 Sidoarjo', 'testimonial' => 'Pekerjaan grounding di Gardu Induk 150 kV sangat memuaskan. Resistansi grounding sesuai target <0.5 ohm. Dokumentasi lengkap dan serah terima yang rapi.', 'rating' => 5, 'order' => 12],
        ];

        foreach ($testimonials as $t) {
            Testimonial::create($t);
        }

        $this->command?->info('Created ' . count($testimonials) . ' testimonials.');
    }

    private function seedMessages(): void
    {
        $messages = [
            ['name' => 'Andi Prayogo', 'email' => 'andi.prayogo@email.com', 'phone' => '081234567890', 'message' => 'Selamat siang, saya ingin konsultasi mengenai pemasangan penangkal petir untuk rumah tinggal 2 lantai di Surabaya. Kira-kira biaya dan waktu pengerjaan berapa? Terima kasih.', 'is_read' => true, 'read_at' => '2025-12-01 09:30:00', 'created_at' => '2025-12-01 08:15:00'],
            ['name' => 'Budi Santoso', 'email' => 'budi@perusahaanku.com', 'phone' => '081234567891', 'message' => 'Kami ada proyek pembangunan pabrik baru di Gresik. Mohon dikirimkan penawaran untuk sistem proteksi petir lengkap termasuk grounding dan SPD untuk area seluas 10 hektar.', 'is_read' => true, 'read_at' => '2025-12-02 10:00:00', 'created_at' => '2025-12-02 07:45:00'],
            ['name' => 'Citra Dewi Lestari', 'email' => 'citra.dewi@email.com', 'phone' => null, 'message' => 'Selamat pagi, apakah ada perbedaan signifikan antara air terminal ESE dengan yang konvensional? Saya sedang mempertimbangkan untuk gedung kantor 8 lantai di Sidoarjo.', 'is_read' => true, 'read_at' => '2025-12-05 08:30:00', 'created_at' => '2025-12-05 08:00:00'],
            ['name' => 'Doni Prasetyo', 'email' => null, 'phone' => '081234567892', 'message' => 'Minta info harga untuk penangkal petir rumah type 120. Lokasi perumahan CitraLand Sidoarjo. Tolong dihubungi via WA ya.', 'is_read' => true, 'read_at' => '2025-12-08 13:00:00', 'created_at' => '2025-12-08 10:30:00'],
            ['name' => 'Eko Wahyudi', 'email' => 'eko.w@perusahaan.com', 'phone' => '085678901234', 'message' => 'Kami membutuhkan jasa pengukuran resistansi grounding untuk 5 titik di pabrik kami. Mohon info biaya survey dan pengukuran. Terima kasih.', 'is_read' => true, 'read_at' => '2025-12-10 09:00:00', 'created_at' => '2025-12-10 08:15:00'],
            ['name' => 'Fitri Handayani', 'email' => 'fitri.handa@email.com', 'phone' => '082345678901', 'message' => 'Apakah ada garansi untuk pemasangan penangkal petir? Rumah saya baru saja dipasang oleh kontraktor lain tapi hasilnya kurang memuaskan. Mohon infonya.', 'is_read' => false, 'read_at' => null, 'created_at' => '2026-01-15 14:20:00'],
            ['name' => 'Gunawan Hartono', 'email' => 'gunawan@rimbajaya.co.id', 'phone' => '081345678902', 'message' => 'Kami dari PT Rimba Jaya, bergerak di bidang properti. Ada 3 proyek apartemen yang akan dimulai tahun depan. Kami butuh vendor proteksi petir untuk semua proyek. Bisakah presentasi?', 'is_read' => true, 'read_at' => '2026-01-20 11:00:00', 'created_at' => '2026-01-20 09:30:00'],
            ['name' => 'Hendra Kusuma', 'email' => null, 'phone' => '087809876543', 'message' => 'Siang, saya butuh SPD untuk panel rumah. Kira-kira yang cocok type berapa? Rumah sederhana 1 lantai di Sidoarjo. Terima kasih.', 'is_read' => false, 'read_at' => null, 'created_at' => '2026-02-01 15:45:00'],
            ['name' => 'Indra Lesmana', 'email' => 'indra.les@company.com', 'phone' => '081234567893', 'message' => 'Kami dari PT Multi Sarana akan melakukan tender ulang proyek grounding dan proteksi petir untuk gudang logistik di Surabaya. Mohon dikirimkan company profile dan daftar harga.', 'is_read' => true, 'read_at' => '2026-02-10 08:00:00', 'created_at' => '2026-02-09 16:30:00'],
            ['name' => 'Joko Susilo', 'email' => 'joko.susilo@email.com', 'phone' => '083456789012', 'message' => 'Minta tolong di cek kondisi penangkal petir di kantor kami. Gedung 5 lantai di Gresik, sudah terpasang sejak 2015. Ingin maintenance rutin. Hubungi saya ya.', 'is_read' => false, 'read_at' => null, 'created_at' => '2026-03-05 10:00:00'],
            ['name' => 'Kartika Wulandari', 'email' => 'kartika.wulan@email.com', 'phone' => '081234567894', 'message' => 'Selamat sore, saya dapat rekomendasi dari teman untuk jasa penangkal petir. Rumah saya di perumahan Permata Sidoarjo. Kira-kira butuh biaya berapa untuk pemasangan?', 'is_read' => true, 'read_at' => '2026-03-20 16:00:00', 'created_at' => '2026-03-20 15:30:00'],
            ['name' => 'Lukman Hakim', 'email' => null, 'phone' => '084567890123', 'message' => 'Retail store saya di mall sering mati lampu mendadak. Kata teknisi mungkin perlu SPD. Mohon info dan penawaran.', 'is_read' => false, 'read_at' => null, 'created_at' => '2026-04-01 11:15:00'],
            ['name' => 'Mega Puspitasari', 'email' => 'mega.puspita@sekolah.sch.id', 'phone' => '081234567895', 'message' => 'Saya kepala sekolah SMK di Sidoarjo. Kami ingin memasang penangkal petir untuk gedung sekolah 4 lantai. Mohon dikirimkan proposal penawaran untuk keperluan pengajuan anggaran.', 'is_read' => true, 'read_at' => '2026-04-15 09:00:00', 'created_at' => '2026-04-14 13:00:00'],
            ['name' => 'Nanda Pratama', 'email' => 'nanda.pratama@startup.id', 'phone' => null, 'message' => 'Kantor startup kami ada di coworking space lantai 18. Apakah perlu proteksi petir tambahan? Mohon saran teknisnya. Terima kasih!', 'is_read' => false, 'read_at' => null, 'created_at' => '2026-05-01 20:30:00'],
            ['name' => 'Oscar Rianto', 'email' => 'oscar@energi.co.id', 'phone' => '081234567896', 'message' => 'Kami mengerjakan proyek PLTS atap 2 MWp di Sidoarjo. Butuh SPD DC untuk proteksi panel surya. Mohon info produk dan harga untuk kuantitas 50 unit.', 'is_read' => false, 'read_at' => null, 'created_at' => '2026-05-20 08:45:00'],
        ];

        foreach ($messages as $msg) {
            Message::create($msg);
        }

        $this->command?->info('Created ' . count($messages) . ' messages.');
    }
}
