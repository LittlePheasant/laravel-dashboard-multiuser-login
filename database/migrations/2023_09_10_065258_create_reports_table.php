<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->index()->constrained()->onDelete('cascade');
            $table->foreignId('program_id')->index()->constrained()->onDelete('cascade');
            $table->string('dates');
            $table->string('title');
            $table->string('type_beneficiary');
            $table->integer('count_male');
            $table->integer('count_female');
            $table->integer('poor_rate');
            $table->integer('fair_rate');
            $table->integer('satisfactory_rate');
            $table->integer('very_satisfactory_rate');
            $table->integer('excellent_rate');
            $table->integer('duration');
            $table->string('unitOpt');
            $table->double('total_trainees_by_duration');
            $table->double('total_rate_by_total_beneficiaries');
            $table->string('serviceOpt');
            $table->string('partners');
            $table->string('faculty_staff_involve');
            $table->double('cost_fund');
            $table->string('filename');
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
};
