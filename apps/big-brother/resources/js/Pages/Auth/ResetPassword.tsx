import { useForm } from '@inertiajs/react';
import { FormEvent } from 'react';
import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';

interface ResetPasswordProps {
    token: string;
    email: string;
}

export default function ResetPassword({ token, email }: ResetPasswordProps) {
    const { data, setData, post, processing, errors } = useForm({
        token,
        email,
        password: '',
        password_confirmation: '',
    });

    function submit(e: FormEvent) {
        e.preventDefault();
        post('/reset-password');
    }

    return (
        <div className="flex min-h-screen items-center justify-center bg-gray-50">
            <div className="w-full max-w-sm rounded-lg bg-white p-8 shadow">
                <h1 className="mb-6 text-center text-2xl font-bold text-gray-900">
                    Reset password
                </h1>

                <form onSubmit={submit} className="space-y-4">
                    <div>
                        <InputLabel htmlFor="email" value="Email" />
                        <TextInput
                            id="email"
                            type="email"
                            value={data.email}
                            onChange={e => setData('email', e.target.value)}
                            required
                            autoComplete="username"
                            className="mt-1"
                        />
                        <InputError message={errors.email} className="mt-1" />
                    </div>

                    <div>
                        <InputLabel htmlFor="password" value="New password" />
                        <TextInput
                            id="password"
                            type="password"
                            value={data.password}
                            onChange={e => setData('password', e.target.value)}
                            required
                            autoComplete="new-password"
                            className="mt-1"
                        />
                        <InputError message={errors.password} className="mt-1" />
                    </div>

                    <div>
                        <InputLabel htmlFor="password_confirmation" value="Confirm password" />
                        <TextInput
                            id="password_confirmation"
                            type="password"
                            value={data.password_confirmation}
                            onChange={e => setData('password_confirmation', e.target.value)}
                            required
                            autoComplete="new-password"
                            className="mt-1"
                        />
                        <InputError message={errors.password_confirmation} className="mt-1" />
                    </div>

                    <PrimaryButton disabled={processing} className="w-full">
                        {processing ? 'Resetting…' : 'Reset password'}
                    </PrimaryButton>
                </form>
            </div>
        </div>
    );
}
