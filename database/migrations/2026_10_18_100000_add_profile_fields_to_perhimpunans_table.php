<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Profil perhimpunan untuk ditampilkan di website profil (pdsionline.org).
     */
    public function up(): void
    {
        Schema::table('perhimpunans', function (Blueprint $table) {
            // Nama file di storage/images/perhimpunan, atau path relatif public (mis. build/images/...)
            $table->string('logo')->nullable();
            $table->text('ringkasan')->nullable();
            $table->text('filosofi')->nullable();
            $table->text('arti_lambang')->nullable();
            $table->text('visi')->nullable();
            // Satu poin per baris
            $table->text('misi')->nullable();
            $table->text('tujuan')->nullable();
            $table->string('slogan')->nullable();
            // Dipisah koma
            $table->string('nilai_dasar')->nullable();
        });

        DB::table('perhimpunans')->where('singkatan', 'PDSKKSI')->update([
            'logo' => 'build/images/perhimpunan/pdskksi.png',
            'ringkasan' => 'Organisasi profesi Dokter Spesialis Kedokteran Keluarga yang mengembangkan pelayanan kedokteran keluarga yang komprehensif, holistik, bermutu, dan berpusat pada individu serta keluarga.',
            'filosofi' => 'Kesehatan individu tidak dapat dipisahkan dari kesehatan keluarga dan lingkungan kehidupannya. PDSKKSI berkomitmen mengembangkan kedokteran keluarga yang komprehensif, holistik, bermutu, aman, berkesinambungan, dan berpusat pada individu serta keluarga, dengan menjunjung tinggi ilmu pengetahuan, etika profesi, integritas, dan nilai kemanusiaan.',
            'arti_lambang' => 'Lingkaran melambangkan persatuan, kebersamaan, kesatuan, kesinambungan, dan keutuhan anggota PDSKKSI. Rumah menggambarkan keluarga sebagai pusat kehidupan, perlindungan, kasih sayang, dan kesehatan. Dua orang dewasa dan anak melambangkan keluarga sebagai satu kesatuan dan pendekatan pelayanan yang melihat pasien dalam konteks keluarga. Stetoskop melambangkan ilmu kedokteran, kompetensi, diagnosis, pelayanan, dan tanggung jawab profesi. Tangan yang mengayomi melambangkan perlindungan, kepedulian, pengabdian, dan pelayanan kemanusiaan. Hijau melambangkan kesehatan, kehidupan, pertumbuhan, harapan, keseimbangan, dan kesejahteraan. Biru melambangkan profesionalisme, keilmuan, integritas, kepercayaan, ketenangan, dan tanggung jawab.',
            'visi' => 'Menjadi organisasi profesi Dokter Spesialis Kedokteran Keluarga yang unggul, profesional, berintegritas, dan terpercaya dalam mengembangkan serta mewujudkan pelayanan kedokteran keluarga yang komprehensif, holistik, bermutu, berkesinambungan, dan berpusat pada individu serta keluarga demi terwujudnya masyarakat Indonesia yang sehat dan sejahtera.',
            'misi' => implode("\n", [
                'Meningkatkan kompetensi dan profesionalisme anggota secara berkelanjutan.',
                'Mengembangkan ilmu pengetahuan dan teknologi kedokteran keluarga melalui pendidikan, penelitian, inovasi, dan publikasi ilmiah.',
                'Mendorong pelayanan promotif, preventif, kuratif, rehabilitatif, dan paliatif yang komprehensif serta holistik.',
                'Mengembangkan pelayanan yang berpusat pada individu dan keluarga dengan menghormati martabat dan hak pasien.',
                'Meningkatkan mutu dan keselamatan pasien dalam pelayanan kedokteran keluarga.',
                'Membangun jejaring dan kemitraan strategis di tingkat nasional maupun internasional.',
                'Mendorong pemerataan pelayanan kedokteran keluarga di seluruh Indonesia.',
                'Membina dan mengembangkan profesionalisme serta kesejahteraan anggota sesuai ketentuan organisasi dan peraturan yang berlaku.',
                'Berperan aktif dalam pembangunan kesehatan nasional dan peningkatan kualitas hidup masyarakat.',
            ]),
            'tujuan' => 'Memajukan ilmu dan profesi kedokteran keluarga; meningkatkan kompetensi Dokter Spesialis Kedokteran Keluarga; mewujudkan pelayanan yang bermutu, aman, efektif, komprehensif, dan berkesinambungan; memperkuat peran keluarga dalam kesehatan; mengembangkan penelitian dan inovasi; serta memberikan kontribusi nyata bagi pembangunan kesehatan dan kesejahteraan masyarakat Indonesia.',
            'slogan' => 'Menguatkan Keluarga, Menyehatkan Bangsa.',
            'nilai_dasar' => 'Integritas, Profesionalisme, Kemanusiaan, Keluarga, Sinergi, Inovasi',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('perhimpunans', function (Blueprint $table) {
            $table->dropColumn([
                'logo',
                'ringkasan',
                'filosofi',
                'arti_lambang',
                'visi',
                'misi',
                'tujuan',
                'slogan',
                'nilai_dasar',
            ]);
        });
    }
};
