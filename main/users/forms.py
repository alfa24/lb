from django import forms
from main.users.models import UserProfile, ProfileCompany, ProfileClient


class SignupForm(forms.ModelForm):
    first_name = forms.CharField(max_length=256)
    last_name = forms.CharField(max_length=256)

    class Meta:
        model = UserProfile
        fields = ('first_name', 'last_name', 'phone', 'type',)
        widgets = {'phone': forms.TextInput()}

    def __init__(self, *args, **kwargs):
        super(SignupForm, self).__init__(*args, **kwargs)

        self.fields['first_name'].required = True
        self.fields['last_name'].required = True
        self.fields['type'].required = True
        self.fields['phone'].required = True
        return

    def signup(self, request, user):
        profile = UserProfile()
        profile.user_id = user.id
        profile.phone = self.cleaned_data['phone']
        profile.type = self.cleaned_data['type']
        profile.save(force_insert=True)

        if profile.type == 'company':
            pc = ProfileCompany(user_profile = profile)
            # pc.user_profile = profile
            pc.rating = 0
            pc.feedback_nmb = 0
            pc.save()

        if profile.type == 'client':
            pc = ProfileClient(user_profile = profile)
            # pc.user_profile = profile
            pc.save()