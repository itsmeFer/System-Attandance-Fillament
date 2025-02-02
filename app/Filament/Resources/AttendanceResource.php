<?php

namespace App\Filament\Resources;

use App\Models\Attendance;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\EditRecord;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\AttendanceResource\Pages;

class AttendanceResource extends Resource
{
    protected static ?string $model = Attendance::class;

    protected static ?string $navigationGroup = 'Attendance';

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    protected static ?string $navigationLabel = 'Attendance';

    
    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label('User')
                    ->required(),
                Forms\Components\DateTimePicker::make('check_in')
                    ->label('Check In')
                    ->required(),
                Forms\Components\DateTimePicker::make('check_out')
                    ->label('Check Out')
                    ->nullable(),
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
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
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
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
{
    return [
        'index' => Pages\ListAttendances::route('/'),
        'create' => Pages\CreateAttendance::route('/create'),
        'edit' => Pages\EditAttendance::route('/{record}/edit'),
    ];
}

}
