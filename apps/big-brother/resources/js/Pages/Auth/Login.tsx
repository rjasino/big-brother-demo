import { useForm } from '@inertiajs/react';
import { FormEvent } from 'react';
import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';

interface LoginProps {
    canResetPassword: boolean;
    status?: string;
}

export default function Login({ canResetPassword, status }: LoginProps) {
    const { data, setData, post, processing, errors } = useForm({
        email: '',
        password: '',
        remember: false as boolean,
    });

    function submit(e: FormEvent) {
        e.preventDefault();
        post('/login');
    }

    return (
        <div className="flex min-h-screen items-center justify-center bg-gray-50">
            <div className="w-full max-w-sm rounded-lg bg-white p-8 shadow">
                <h1 className="mb-6 text-center text-2xl font-bold text-gray-900">Sign in</h1>

                {status && (
                    <div className="mb-4 rounded bg-green-50 p-3 text-sm text-green-700">
                        {status}
                    </div>
                )}

                <form onSubmit={submit} className="space-y-4">
                    <div>
                        <InputLabel htmlFor="email" value="Email" />
                        <TextInput
                            id="email"
                            type="email"
                            value={data.email}
                            onChange={e => setData('email', e.target.value)}
                            autoFocus
                            required
                            autoComplete="username"
                            className="mt-1"
                        />
                        <InputError message={errors.email} className="mt-1" />
                    </div>

                    <div>
                        <InputLabel htmlFor="password" value="Password" />
                        <TextInput
                            id="password"
                            type="password"
                            value={data.password}
                            onChange={e => setData('password', e.target.value)}
                            required
                            autoComplete="current-password"
                            className="mt-1"
                        />
                        <InputError message={errors.password} className="mt-1" />
                    </div>

                    <div className="flex items-center">
                        <input
                            id="remember"
                            type="checkbox"
                            checked={data.remember}
                            onChange={e => setData('remember', e.target.checked)}
                            className="h-4 w-4 rounded border-gray-300 text-indigo-600"
                        />
                        <label htmlFor="remember" className="ml-2 text-sm text-gray-600">
                            Remember me
                        </label>
                    </div>

                    <div className="flex items-center justify-between">
                        {canResetPassword && (
                            <a
                                href="/forgot-password"
                                className="text-sm text-indigo-600 hover:text-indigo-500"
                            >
                                Forgot password?
                            </a>
                        )}
                        <PrimaryButton disabled={processing} className="ml-auto">
                            {processing ? 'Signing in…' : 'Sign in'}
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    );
}
