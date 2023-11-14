<x-mail::message>
    <div style="background-color: #f4f4f4; padding: 20px; font-family: Arial, sans-serif;">
        <h2 style="color: #333;">تفعيل حسابك</h2>
        <p style="color: #666;">هذا هو كود التفعيل لتغيير كلمة المرور الخاصة بك: <strong>{{ $code }}</strong></p>
        <p style="color: #666;">يرجى عدم مشاركة هذا الكود مع أي شخص.</p>
        <p style="color: #888;">مع تحيات {{ config('app.name') }}</p>
    </div>
</x-mail::message>
