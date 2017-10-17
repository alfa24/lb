from __future__ import print_function
from django.conf import settings
from django.contrib.auth.models import User
from django.dispatch import receiver
from allauth.account.signals import user_signed_up, email_confirmed, user_logged_in
from main.users.models import UserProfile, ProfileCompany


@receiver(user_signed_up, dispatch_uid="user_signed_up")
def create_new_profile(request, **kwargs):
    if settings.DEBUG:
        print('# ============ Signal fired: "user_signed_up" ============= #')
    if not request.user.is_authenticated():
        return

    if settings.DEBUG:
        user = User.objects.get(username=kwargs['user'])
        print('New profile created for user ' + user.username)
    return


@receiver(email_confirmed, dispatch_uid="email_confirmed")
def set_email_confirmed(request, **kwargs):
    pass
    # if settings.DEBUG:
    #     print('# ============ Signal fired: "email_confirmed" ============= #')
    # if not request.user.is_authenticated():
    #     return
    # else:
    #     if settings.DEBUG:
    #         print('User is identified : '+request.user.username)
    #     user = request.user
    # profile = UserProfile.objects.get(user=user)
    # profile.email_is_verified = True
    # profile.completion_level = profile.get_completion_level()
    # profile.save()
    # if settings.DEBUG:
    #     print('Email set as verified')
    # return
