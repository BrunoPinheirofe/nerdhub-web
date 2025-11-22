<?php

namespace App\Filament\Resources\News\Schemas;

use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class NewsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('titulo')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                MarkdownEditor::make('conteudo')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('imagem_url')
                    ->url(),
                Select::make('autor')
                    ->relationship('author', 'name')
                    ->searchable()
                    ->required(),
            ]);
    }
}
