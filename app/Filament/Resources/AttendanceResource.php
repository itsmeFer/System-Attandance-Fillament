<?php

namespace App\Filament\Resources;

use App\Models\Attendance;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Widgets\Card;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttendanceResource extends Resource
{
    protected static ?string $model = Attendance::class;

    protected static ?string $navigationGroup = 'Attendance';
    
    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    protected static ?string $navigationLabel = 'Attendance';

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('user.name')
                ->label('User')
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make('check_in')
                ->label('Check In')
                ->sortable(),
            Tables\Columns\TextColumn::make('check_out')
                ->label('Check Out')
                ->sortable(),
            Tables\Columns\TextColumn::make('check_in_location')
                ->label('Check In Location')
                ->sortable(),
            Tables\Columns\TextColumn::make('check_out_location')
                ->label('Check Out Location')
                ->sortable(),
            Tables\Columns\ImageColumn::make('photo')
                ->label('Photo')
                ->image()
                ->sortable(),
        ];
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('user_id')
                ->label('User')
                ->required()
                ->relationship('user', 'name'),
            Forms\Components\DateTimePicker::make('check_in')
                ->label('Check In')
                ->required(),
            Forms\Components\DateTimePicker::make('check_out')
                ->label('Check Out')
                ->required(),
            Forms\Components\TextInput::make('check_in_location')
                ->label('Check In Location')
                ->nullable(),
            Forms\Components\TextInput::make('check_out_location')
                ->label('Check Out Location')
                ->nullable(),
            Forms\Components\FileUpload::make('photo')
                ->label('Photo')
                ->image()
                ->nullable(),
        ];
    }
}
