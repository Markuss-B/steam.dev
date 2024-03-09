<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGameRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        // Schema::create('games', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('name', 255);
        //     $table->string('description', 1000)->nullable();
        //     $table->integer('price');
        //     $table->integer('discount');
        //     $table->date('release_date')->nullable();
        //     $table->timestamps();
        // });
        // Schema::create('developer_game', function (Blueprint $table) {
        //     $table->foreignId('game_id')->constrained('games');
        //     $table->foreignId('developer_id')->constrained('developers');
        //     $table->primary(['game_id', 'developer_id']);
        //     $table->timestamps();
        // });
        // Schema::create('game_publisher', function (Blueprint $table) {
        //     $table->foreignId('game_id')->constrained('games');
        //     $table->foreignId('publisher_id')->constrained('publishers');
        //     $table->primary(['game_id', 'publisher_id']);
        //     $table->timestamps();
        // });
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'price' => 'required|integer|min:0',
            'discount' => 'required|integer|min:0|max:100',
            'release_date' => 'nullable|date',
            'developers' => 'required|array',
            'developers.*' => 'required|integer|exists:developers,id',
            // icon, library_hero and header
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'library_hero' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'header' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
