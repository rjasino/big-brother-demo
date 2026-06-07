import { ButtonHTMLAttributes } from 'react';

type PrimaryButtonProps = ButtonHTMLAttributes<HTMLButtonElement>;

export default function PrimaryButton({ className = '', disabled, children, ...props }: PrimaryButtonProps) {
    return (
        <button
            {...props}
            disabled={disabled}
            className={`inline-flex items-center justify-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 ${className}`}
        >
            {children}
        </button>
    );
}
