<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });



        // Rezervasyonlar
        Schema::create('reservations', function (Blueprint $table) {
            $table->id()->comment('Rezervasyon ID');
            $table->text('customer_name')->comment('Müşteri Adı');
            $table->dateTime('reservation_date')->comment('Rezervasyon Tarihi');
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending')->comment('Rezervasyon Durumu');
            $table->text('notes')->nullable()->comment('Notlar');
            $table->unsignedBigInteger('table_id')->comment('Masa ID');
            $table->timestamps();
            $table->softDeletes()->comment('Yumuşak Silme');
        });


        Schema::create('tables', function (Blueprint $table) {
            $table->id()->comment('Masa ID');
            $table->string('name')->comment('Masa Adı');
            $table->integer('capacity')->comment('Kapasite');
            $table->text('status')->default('0')->comment('Masa Durumu');
            $table->text('employee_id')->nullable()->comment('İlgili Çalışan ID');
        });


        // Bildirimler
        Schema::create('notifications', function (Blueprint $table) {
            $table->id()->comment('Bildirim ID');
            $table->unsignedBigInteger('reservation_id')->comment('Rezervasyon ID');
            $table->enum('type', ['email', 'sms'])->comment('Bildirim Türü');
            $table->text('message')->comment('Bildirim Mesajı');
            $table->timestamps();
        });

        // Geri Bildirimler
        Schema::create('feedback', function (Blueprint $table) {
            $table->id()->comment('Geri Bildirim ID');
            $table->unsignedBigInteger('customer_id')->comment('Müşteri ID');
            $table->text('feedback')->comment('Geri Bildirim');
            $table->timestamps();
        });

        // Anketler
        Schema::create('surveys', function (Blueprint $table) {
            $table->id()->comment('Anket ID');
            $table->string('title')->comment('Anket Başlığı');
            $table->text('description')->nullable()->comment('Anket Açıklaması');
            $table->timestamps();
        });

        Schema::create('survey_responses', function (Blueprint $table) {
            $table->id()->comment('Anket Yanıt ID');
            $table->unsignedBigInteger('survey_id')->comment('Anket ID');
            $table->unsignedBigInteger('customer_id')->comment('Müşteri ID');
            $table->text('response')->comment('Anket Yanıtı');
            $table->timestamps();
        });

        // Faturalar
        Schema::create('invoices', function (Blueprint $table) {
            $table->id()->comment('Fatura ID');
            $table->unsignedBigInteger('customer_id')->comment('Müşteri ID');
            $table->decimal('amount', 10, 2)->comment('Tutar');
            $table->enum('status', ['pending', 'paid', 'cancelled'])->default('pending')->comment('Fatura Durumu');
            $table->dateTime('due_date')->nullable()->comment('Son Ödeme Tarihi');
            $table->timestamps();
        });

        // Finansal Kayıtlar (Gelir ve gider için)
        Schema::create('financial_records', function (Blueprint $table) {
            $table->id()->comment('Finansal Kayıt ID');
            $table->enum('type', ['income', 'expense'])->comment('Kayıt Türü');
            $table->decimal('amount', 10, 2)->comment('Tutar');
            $table->string('description')->nullable()->comment('Açıklama');
            $table->unsignedBigInteger('related_invoice_id')->nullable()->comment('İlgili Fatura ID');
            $table->timestamps();
        });

        Schema::create('employees', function (Blueprint $table) {
            $table->id()->comment('Çalışan ID');
            $table->text('name')->comment('Çalışan Adı'); // Çalışan adı
            $table->decimal('salary', 10, 2)->comment('Maaş'); // Maaş
            $table->integer('leave_days')->default(0)->comment('Kullanılan İzin Günleri'); // Kullanılan izin günleri
            $table->text('annual_leave_days')->comment(' İzin Günleri'); // Yıllık izin günleri
            $table->text('position')->comment('Pozisyon'); // Çalışanın pozisyonu
            $table->text('phone')->nullable()->comment('Telefon Numarası'); // Çalışanın telefon numarası
            $table->date('hire_date')->nullable()->comment('İşe Giriş Tarihi'); // Çalışanın işe giriş tarihi
            $table->text('email')->unique()->comment('E-posta Adresi'); // Çalışanın e-posta adresi
            $table->text('skills')->nullable()->comment('Beceriler'); // Çalışanın becerileri
            $table->text('table_id')->nullable()->comment('Sorumlu Olduğu Oda'); // Çalışanın sorumlu olduğu oda
            $table->boolean('is_active')->default(true)->comment('Aktif Durumu'); // Çalışanın aktif durumu
            $table->timestamps();
        });



        Schema::create('sms_send_settings', function (Blueprint $table) {
            $table->id();
            $table->string('username')->nullable()->comment('Username');
            $table->string('password')->nullable()->comment('Password');
            $table->string('title')->nullable()->comment('Title');
            $table->string('originator')->nullable()->comment(comment: 'Originator');
            $table->integer('quota')->default(0)->comment('Kota');
            $table->timestamps();
        });


        Schema::create('customers', function (Blueprint $table) {
            $table->id(); // Unique ID for each customer
            $table->string('first_name', 100); // First name of the customer
            $table->string('last_name', 100); // Last name of the customer
            $table->string('email')->unique(); // Email of the customer
            $table->string('phone', 20)->nullable(); // Phone number
            $table->string('password')->nullable(); // Password
            $table->date('date_of_birth')->nullable(); // Date of birth
            $table->enum('gender', ['erkek', 'kadin', 'diger'])->nullable(); // Gender
            $table->string('address_line1')->nullable(); // Address line 1
            $table->string('address_line2')->nullable(); // Address line 2
            $table->string('city', 100)->nullable(); // City
            $table->string('state', 100)->nullable(); // State or region
            $table->string('postal_code', 20)->nullable(); // Postal/ZIP code
            $table->string('country', 100)->default('Turkey'); // Country, default to Turkey
            $table->boolean('is_vip')->default(false); // VIP status
            $table->integer('total_visits')->default(0); // Total visits to the beauty center
            $table->decimal('total_spent', 10, 2)->default(0.00); // Total amount spent by the customer
            $table->date('last_visit')->nullable(); // Date of last visit
            $table->string('preferred_services')->nullable(); // Preferred services (e.g., "manicure,pedicure")
            $table->string('notes', 500)->nullable(); // Additional notes about the customer
            $table->timestamps(); // Created at and updated at
            $table->softDeletes(); // Soft delete to archive customers
        });



        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('campaign_name');
            $table->string('campaign_type');
            $table->string('campaign_details');
            $table->string('send_type');
            $table->date('date');
        });


        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->comment('Kategori adı, örneğin: Saç Bakımı, Cilt Bakımı');
            $table->text('description')->nullable()->comment('Kategori hakkında açıklama');
            $table->text('image')->nullable()->comment('Kategori görseli');

            $table->boolean('is_active')->default(true)->comment('Kategori aktif mi?');
            $table->timestamps();
        });

        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Hizmetin adı, örneğin: saç kesimi, manikür');
            $table->text('description')->nullable()->comment('Hizmetin açıklaması');
            $table->decimal('price', 10, 2)->comment('Hizmetin fiyatı (örn. 150.00 TL)'); // 10,2 daha yaygın bir boyut
            $table->integer('duration')->comment('Hizmetin süresi (dakika olarak)'); // integer kullanarak sadece dakika bilgisi tutuyoruz
            $table->string('image')->nullable()->comment('Hizmetin görsel bağlantısı'); // resim alanını string yaparak url gibi bağlantıları kaydediyoruz
            $table->unsignedBigInteger('employee_id')->nullable()->comment('Hizmeti yapan çalışan');
            $table->boolean('is_active')->default(true)->comment('Hizmet aktif mi?'); // Hizmetin aktif/pasif durumunu belirler
            $table->decimal('discount_price', 10, 2)->nullable()->comment('Hizmet için indirimli fiyat'); // indirimli fiyat varsa
            $table->unsignedBigInteger('category_id')->nullable()->comment('Hizmetin ait olduğu kategori'); // kategori ilişkisi (örn. cilt bakımı, saç bakımı)
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
