# -*- coding: utf-8 -*-
# Generated by Django 1.11.6 on 2017-10-26 07:25
from __future__ import unicode_literals

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('services', '0001_initial'),
    ]

    operations = [
        migrations.RemoveField(
            model_name='service',
            name='category',
        ),
        migrations.AddField(
            model_name='service',
            name='category',
            field=models.ManyToManyField(to='services.ServiceCategory'),
        ),
    ]
