<?php

use App\Enums\TicketStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->unsignedTinyInteger('category_id');
            $table->string('subject');
            $table->text('description');
            $table->unsignedTinyInteger('parent_id')->default(0);
            $table->unsignedTinyInteger('status')->default(TicketStatus::PENDING);
            $table->unsignedTinyInteger('creator_id')->default(0);
            $table->unsignedTinyInteger('editor_id')->default(0);
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
        Schema::dropIfExists('tickets');
    }
}
