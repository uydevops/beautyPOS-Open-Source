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
            $table->string('name')->comment('Çalışan Adı');
            $table->decimal('salary', 10, 2)->comment('Maaş');
            $table->integer('leave_days')->default(0)->comment('Kullanılan İzin Günleri'); // Kullanılan izin günleri
            $table->integer('annual_leave_days')->default(0)->comment('Yıllık İzin Günleri'); // Yıllık izin günleri
            $table->timestamps();
        });

        Schema::create('leave_requests', function (Blueprint $table) {
            $table->id()->comment('İzin Talebi ID');
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade')->comment('Çalışan ID');
            $table->date('start_date')->comment('İzin Başlangıç Tarihi');
            $table->date('end_date')->comment('İzin Bitiş Tarihi');
            $table->integer('days')->comment('Kullanılan İzin Günleri');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->comment('İzin Talebi Durumu');
            $table->timestamps();
        });


        Schema::create('payroll', function (Blueprint $table) {
            $table->id()->comment('Bordro ID');
            $table->unsignedBigInteger('employee_id')->comment('Çalışan ID');
            $table->decimal('salary', 10, 2)->comment('Maaş Tutarı');
            $table->decimal('tax', 10, 2)->comment('Vergi Kesintisi');
            $table->decimal('social_security', 10, 2)->comment('Sosyal Güvenlik Kesintisi');
            $table->timestamps();
        });

        // Finansal Raporlama
        Schema::create('financial_reports', function (Blueprint $table) {
            $table->id()->comment('Finansal Rapor ID');
            $table->enum('report_type', ['income_statement', 'balance_sheet', 'cash_flow'])->comment('Rapor Türü');
            $table->text('details')->comment('Rapor Detayları');
            $table->timestamps();
        });

        // Restoran Yönetimi
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id()->comment('Menü Öğesi ID');
            $table->string('name')->comment('Menü Öğesi Adı');
            $table->decimal('price', 10, 2)->comment('Fiyat');
            $table->text('description')->nullable()->comment('Açıklama');
            $table->timestamps();
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->id()->comment('Sipariş ID');
            $table->unsignedBigInteger('table_id')->comment('Masa ID');
            $table->unsignedBigInteger('menu_item_id')->comment('Menü Öğesi ID');
            $table->integer('quantity')->comment('Adet');
            $table->decimal('total_price', 10, 2)->comment('Toplam Fiyat');
            $table->enum('status', ['pending', 'served', 'cancelled'])->default('pending')->comment('Sipariş Durumu');
            $table->timestamps();
        });

      
        // Stok Yönetimi
        Schema::create('inventory', function (Blueprint $table) {
            $table->id()->comment('Envanter ID');
            $table->string('item_name')->comment('Ürün Adı');
            $table->integer('quantity')->comment('Adet');
            $table->decimal('price', 10, 2)->comment('Fiyat');
            $table->timestamps();
        });

        Schema::create('suppliers', function (Blueprint $table) {
            $table->id()->comment('Tedarikçi ID');
            $table->string('supplier_name')->comment('Tedarikçi Adı');
            $table->string('contact_info')->nullable()->comment('İletişim Bilgileri');
            $table->timestamps();
        });

        Schema::create('inventory_purchases', function (Blueprint $table) {
            $table->id()->comment('Envanter Alımı ID');
            $table->unsignedBigInteger('supplier_id')->comment('Tedarikçi ID');
            $table->unsignedBigInteger('inventory_id')->comment('Envanter ID');
            $table->integer('quantity')->comment('Adet');
            $table->decimal('total_cost', 10, 2)->comment('Toplam Maliyet');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
