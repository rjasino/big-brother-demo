import { usePage } from '@inertiajs/react';
import { PageProps } from '@/types/auth.types';

export default function Dashboard() {
    const { auth } = usePage<PageProps>().props;
    const user = auth.user!;

    return (
        <div className="flex min-h-screen flex-col bg-gray-50">
            <header className="bg-white shadow">
                <div className="mx-auto flex max-w-5xl items-center justify-between px-6 py-4">
                    <h1 className="text-lg font-semibold text-gray-900">Big Brother SMS</h1>
                    <div className="flex items-center gap-4">
                        <span className="text-sm text-gray-600">{user.name}</span>
                        <form method="POST" action="/logout">
                            <input
                                type="hidden"
                                name="_token"
                                value={document.querySelector<HTMLMetaElement>('meta[name="csrf-token"]')?.content ?? ''}
                            />
                            <button
                                type="submit"
                                className="text-sm text-red-600 hover:text-red-500"
                            >
                                Sign out
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <main className="mx-auto mt-10 w-full max-w-5xl px-6">
                <p className="mb-8 text-gray-600">
                    Welcome back, <strong>{user.name}</strong>.
                </p>

                <div className="grid gap-6 sm:grid-cols-2">
                    {user.role === 'registrar' && (
                        <ModuleCard
                            title="Enrollment"
                            description="Manage student enrollments, add or drop courses."
                            href="/enrollment"
                        />
                    )}

                    {user.role === 'faculty' && (
                        <>
                            <ModuleCard
                                title="Load Assignment"
                                description="View your assigned courses for the current term."
                                href="/load-assignments"
                            />
                            <ModuleCard
                                title="Attendance"
                                description="Record and review attendance for your classes."
                                href="/attendance"
                            />
                        </>
                    )}
                </div>
            </main>
        </div>
    );
}

interface ModuleCardProps {
    title: string;
    description: string;
    href: string;
}

function ModuleCard({ title, description, href }: ModuleCardProps) {
    return (
        <a
            href={href}
            className="block rounded-lg border border-gray-200 bg-white p-6 shadow-sm transition hover:border-indigo-300 hover:shadow"
        >
            <h2 className="text-base font-semibold text-gray-900">{title}</h2>
            <p className="mt-1 text-sm text-gray-500">{description}</p>
            <span className="mt-4 inline-block text-sm font-medium text-indigo-600">
                Open →
            </span>
        </a>
    );
}
