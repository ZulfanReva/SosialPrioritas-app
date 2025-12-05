<?php

namespace App\Filament\Auth;

use App\Models\User;
use Filament\Actions\Action;
use Filament\Auth\Pages\Login;
use Illuminate\Support\HtmlString;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Component;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Validation\ValidationException;

class LoginSosialPrioritas extends Login
{

    public function getTitle(): string|Htmlable
    {
        return 'Selamat Datang 👋🏻';
    }

    public function getHeading(): string|Htmlable
    {
        return 'DINSOS KOTA BANJARMASIN';
    }

    protected function getEmailFormComponent(): Component
    {
        return TextInput::make('email')
            ->label('Alamat Email')
            ->email()
            ->required()
            ->autocomplete()
            ->autofocus()
            ->placeholder('Masukan email kamu')
            ->extraInputAttributes(['tabindex' => 1])
            ->validationMessages([
                'required' => 'Alamat email wajib diisi.',
                'email' => 'Format alamat email tidak valid.',
            ]);
    }

    protected function getPasswordFormComponent(): Component
    {
        return TextInput::make('password')
            ->label('Kata Sandi')
            ->password()
            ->revealable(filament()->arePasswordsRevealable())
            ->autocomplete('current-password')
            ->required()
            ->placeholder('Masukan kata sandi kamu')
            ->extraInputAttributes(['tabindex' => 2])
            ->validationMessages([
                'required' => 'Kata sandi wajib diisi.',
            ]);
    }

    protected function getRememberFormComponent(): Component
    {
        return Checkbox::make('remember')
            ->label('Ingat Saya');
    }

    public function getSubheading(): string | Htmlable | null
    {
        if (! filament()->hasRegistration()) {
            return null;
        }

        return new HtmlString('Belum punya akun ? ' . $this->registerAction->toHtml());
    }

    public function registerAction(): Action
    {
        return parent::registerAction()
            ->label('daftar disini');
    }

    // Method baru yang ditambahkan untuk mengubah label tombol Sign in
    protected function getAuthenticateFormAction(): Action
    {
        return Action::make('authenticate')
            ->label('Masuk')
            ->submit('authenticate');
    }

    // Override method untuk custom error messages pada proses otentikasi
    protected function throwFailureValidationException(): never
    {
        $this->addError('data.email', 'Email atau kata sandi yang Anda masukkan tidak valid.');

        throw ValidationException::withMessages([
            'data.email' => 'Email atau kata sandi yang Anda masukkan tidak valid.',
        ]);
    }

    /**
     * Override untuk validasi tambahan sebelum login
     */
    protected function getCredentialsFromFormData(array $data): array
    {
        // Cari user berdasarkan email
        $user = User::where('email', $data['email'])->first();

        // Cek jika user ada dan tidak aktif
        if ($user && !$user->is_active) {
            $this->addError('data.email', 'Akun Anda telah dinonaktifkan. Silakan hubungi administrator.');

            throw ValidationException::withMessages([
                'data.email' => 'Akun Anda telah dinonaktifkan. Silakan hubungi administrator.',
            ]);
        }

        return parent::getCredentialsFromFormData($data);
    }

    protected function getFormActions(): array
    {
        return [
            $this->getAuthenticateFormAction(),
        ];
    }
}
