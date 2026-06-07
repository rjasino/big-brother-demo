import { useForm } from '@inertiajs/react';
import { FormEvent } from 'react';
import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';

interface ForgotPasswordProps {
    status?: string;
}

export default function ForgotPassword({ status }: ForgotPasswordProps) {
    const { data, setData, post, processing, errors } = useForm({ email: '' });

    function submit(e: FormEvent) {
        e.preventDefault();
        post('/forgot-password');
    }

    return (
        <div className="flex min-h-screen items-center justify-center bg-gray-50">
            <div className="w-full max-w-sm rounded-lg bg-white p-8 shadow">
                <h1 className="mb-2 text-center text-2xl font-bold text-gray-900">
                    Forgot password?
                </h1>
                <p className="mb-6 text-center text-sm text-gray-600">
                    Enter your email and we'll send you a reset link.
                </p>

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
                            className="mt-1"
                        />
                        <InputError message={errors.email} className="mt-1" />
                    </div>

                    <PrimaryButton disabled={processing} className="w-full">
                        {processing ? 'Sending…' : 'Send reset link'}
                    </PrimaryButton>
                </form>

                <p className="mt-4 text-center text-sm">
                    <a href="/login" className="text-indigo-600 hover:text-indigo-500">
                        Back to sign in
                    </a>
                </p>
            </div>
        </div>
    );
}
