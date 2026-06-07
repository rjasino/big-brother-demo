export interface AuthUser {
    id: number;
    name: string;
    email: string;
    role: 'faculty' | 'registrar';
}

export type PageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    auth: {
        user: AuthUser | null;
    };
    flash: {
        success?: string;
    };
};
