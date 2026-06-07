import { LabelHTMLAttributes } from 'react';

interface InputLabelProps extends LabelHTMLAttributes<HTMLLabelElement> {
    value?: string;
}

export default function InputLabel({ value, children, className = '', ...props }: InputLabelProps) {
    return (
        <label {...props} className={`block text-sm font-medium text-gray-700 ${className}`}>
            {value ?? children}
        </label>
    );
}
