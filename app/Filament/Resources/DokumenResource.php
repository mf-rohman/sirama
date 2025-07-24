<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DokumenResource\Pages;
use App\Models\Dokumen;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class DokumenResource extends Resource
{
    protected static ?string $model = Dokumen::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    // Filter data yang tampil di tabel utama berdasarkan role user yang login
    public static function getEloquentQuery(): Builder
    {
        $user = Auth::user();

        // Jika yang login adalah Dosen, hanya tampilkan dokumen miliknya
        if ($user->isDosen()) {
            return parent::getEloquentQuery()->where('user_id', $user->id);
        }

        // Jika Admin atau Verifikator, tampilkan semua dokumen
        return parent::getEloquentQuery();
    }

    public static function form(Form $form): Form
    {
        $user = Auth::user();

        return $form
            ->schema([
                // Field ini hanya terlihat oleh Admin/Verifikator untuk memilih pemilik dokumen
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label('Pemilik Dokumen')
                    ->searchable()
                    ->preload()
                    // Hanya terlihat oleh verifikator/admin. Untuk Dosen, user_id akan diisi otomatis.
                    ->visible($user->isVerificator() || $user->isAdmin()),

                Forms\Components\Select::make('kategori_id')
                    ->relationship('kategori', 'nama_kategori') // Menampilkan nama kategori
                    ->searchable()
                    ->preload()
                    ->required(),

                Forms\Components\TextInput::make('judul')
                    ->required()
                    ->maxLength(255),

                // Menggunakan FileUpload untuk mengunggah file
                Forms\Components\FileUpload::make('file_path')
                    ->label('Upload Dokumen')
                    ->directory('dokumen-dosen') // Simpan di folder storage/app/public/dokumen-dosen
                    ->disk('public')
                    ->required(),

                // === AREA KHUSUS VERIFIKATOR & ADMIN ===
                Forms\Components\Section::make('Area Verifikasi')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->options([
                                'diunggah' => 'Diunggah',
                                'diverifikasi' => 'Diverifikasi',
                                'ditolak' => 'Ditolak',
                            ])
                            ->default('diunggah')
                            ->required(),
                        Forms\Components\Textarea::make('catatan_verifikator')
                            ->rows(3),
                    ])
                    // Section ini hanya akan muncul jika user adalah Verifikator atau Admin
                    ->visible($user->isVerificator() || $user->isAdmin()),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Menampilkan nama pemilik dokumen, bukan ID
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Pemilik')
                    ->searchable()
                    ->sortable(),
                // Menampilkan nama kategori, bukan ID
                Tables\Columns\TextColumn::make('kategori.nama_kategori')
                    ->label('Kategori')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('judul')
                    ->searchable(),
                // Memberi badge warna pada status
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'diunggah' => 'warning',
                        'diverifikasi' => 'success',
                        'ditolak' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDokumens::route('/'),
            'create' => Pages\CreateDokumen::route('/create'),
            'edit' => Pages\EditDokumen::route('/{record}/edit'),
        ];
    }
}
