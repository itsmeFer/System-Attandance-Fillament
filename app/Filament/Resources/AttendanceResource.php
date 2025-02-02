<?php

namespace App\Filament\Resources;

use App\Models\Attendance;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\AttendanceResource\Pages\ListAttendances;
use App\Filament\Resources\AttendanceResource\Pages\CreateAttendances;
use App\Filament\Resources\AttendanceResource\Pages\EditAttendances;
use App\Filament\Resources\AttendanceResource\Pages\CreateAttendance;
use App\Filament\Resources\AttendanceResource\Pages\EditAttendance;

class AttendanceResource extends Resource
{
    protected static ?string $model = Attendance::class;
    protected static ?string $navigationIcon = 'heroicon-o-clock';
    protected static ?string $navigationGroup = 'Absensi Karyawan';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('user_id')
                ->label('User ID')
                ->required(),

            Forms\Components\DateTimePicker::make('check_in_time')
                ->label('Check In Time')
                ->required(),

            Forms\Components\TextInput::make('check_in_location')
                ->label('Check In Location')
                ->required(),

            Forms\Components\DateTimePicker::make('check_out_time')
                ->label('Check Out Time'),

            Forms\Components\TextInput::make('check_out_location')
                ->label('Check Out Location'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user_id')
                    ->label('User ID')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('check_in_time')
                    ->label('Check In Time')
                    ->dateTime()
                    ->sortable(),

                Tables\Columns\TextColumn::make('check_in_location')
                    ->label('Check In Location'),

                Tables\Columns\TextColumn::make('check_out_time')
                    ->label('Check Out Time')
                    ->dateTime()
                    ->sortable(),

                Tables\Columns\TextColumn::make('check_out_location')
                    ->label('Check Out Location'),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAttendances::route('/'),
            'create' => CreateAttendance::route('/create'),
            'edit' => EditAttendance::route('/{record}/edit'),
        ];
    }
    
}
