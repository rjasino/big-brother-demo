import { forwardRef, InputHTMLAttributes } from 'react';

type TextInputProps = InputHTMLAttributes<HTMLInputElement>;

const TextInput = forwardRef<HTMLInputElement, TextInputProps>(
    ({ className = '', ...props }, ref) => (
        <input
            ref={ref}
            {...props}
            className={`w-full rounded-md border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 ${className}`}
        />
    ),
);

TextInput.displayName = 'TextInput';

export default TextInput;
