import { useForm, usePage } from '@inertiajs/react';
import { FormEvent } from 'react';
import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import { PageProps } from '@/types/auth.types';

export default function Register() {
    const { flash } = usePage<PageProps>().props;

    const { data, setData, post, processing, errors, reset } = useForm({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
        role: 'registrar' as 'faculty' | 'registrar',
    });

    function submit(e: FormEvent) {
        e.preventDefault();
        post('/register', {
            onSuccess: () => reset('password', 'password_confirmation'),
        });
    }

    return (
        <div className="flex min-h-screen items-center justify-center bg-gray-50">
            <div className="w-full max-w-sm rounded-lg bg-white p-8 shadow">
                <h1 className="mb-6 text-center text-2xl font-bold text-gray-900">
                    Create account
                </h1>

                {flash.success && (
                    <div className="mb-4 rounded bg-green-50 p-3 text-sm text-green-700">
                        {flash.success}
                    </div>
                )}

                <form onSubmit={submit} className="space-y-4">
                    <div>
                        <InputLabel htmlFor="name" value="Full name" />
                        <TextInput
                            id="name"
                            type="text"
                            value={data.name}
                            onChange={e => setData('name', e.target.value)}
                            autoFocus
                            required
                            autoComplete="name"
                            className="mt-1"
                        />
                        <InputError message={errors.name} className="mt-1" />
                    </div>

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
                        <InputLabel htmlFor="role" value="Role" />
                        <select
                            id="role"
                            value={data.role}
                            onChange={e => setData('role', e.target.value as 'faculty' | 'registrar')}
                            className="mt-1 w-full rounded-md border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500"
                        >
                            <option value="registrar">Registrar</option>
                            <option value="faculty">Faculty</option>
                        </select>
                        <InputError message={errors.role} className="mt-1" />
                    </div>

                    <div>
                        <InputLabel htmlFor="password" value="Password" />
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
                        {processing ? 'Creating…' : 'Create account'}
                    </PrimaryButton>
                </form>
            </div>
        </div>
    );
}
